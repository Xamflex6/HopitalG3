#!/bin/bash
# Author : Laeliha Ratib
# Variables
BACKUP_DIR="/backup"
DB_NAME="db_soins_intensifs"
DB_USER="backup_user"
DB_PASS="backup_password"
SQL_FILE="/srv/database.sql"
CRON_FILE="/backup/backup_script.sh"
GIT_REPO="https://github.com/Xamflex6/HopitalG3.git"
SOURCE_DIR="/path/to/source"

# Update system
sudo dnf update -y

# Disable SELinux
sudo setenforce 0
sudo sed -i 's/^SELINUX=enforcing$/SELINUX=permissive/' /etc/selinux/config

# Disable IPv6
sudo sysctl -w net.ipv6.conf.all.disable_ipv6=1
sudo sysctl -w net.ipv6.conf.default.disable_ipv6=1
echo "net.ipv6.conf.all.disable_ipv6 = 1" | sudo tee -a /etc/sysctl.conf
echo "net.ipv6.conf.default.disable_ipv6 = 1" | sudo tee -a /etc/sysctl.conf

# Enable EPEL repository
sudo dnf install epel-release -y

# Install necessary packages
sudo dnf -y install nfs-utils samba bind chrony vsftpd rsync bind-utils httpd php php-mysqlnd php-fpm mariadb-server mod_ssl lynx git fail2ban clamav clamav-update phpMyAdmin

# Configure static IP
cat <<EOL | sudo tee /etc/sysconfig/network-scripts/ifcfg-eth0
TYPE=Ethernet
BOOTPROTO=static
IPADDR=172.17.0.2
PREFIX=16
GATEWAY=172.17.255.254
DNS1=172.20.0.1
DNS2=172.17.0.1
DEFROUTE=yes
IPV4_FAILURE_FATAL=no
IPV6INIT=no
NAME=eth0
DEVICE=eth0
ONBOOT=yes
EOL

sudo systemctl restart NetworkManager

# Configure static IP with nmcli
sudo nmcli con mod "eth0" ipv4.addresses "172.17.0.2/16"
sudo nmcli con mod "eth0" ipv4.gateway "172.17.255.254"
sudo nmcli con mod "eth0" ipv4.dns "172.20.0.1 172.17.0.1"
sudo nmcli con mod "eth0" ipv4.method manual
sudo nmcli con mod "eth0" connection.autoconnect yes
sudo nmcli con down "eth0"
sudo nmcli con up "eth0"

sudo systemctl restart NetworkManager

# Install and configure Apache
sudo dnf install httpd -y
sudo systemctl start httpd
sudo systemctl enable httpd

# Install and configure PHP
sudo dnf install php php-mysqlnd php-fpm -y
sudo systemctl restart httpd

# Install MariaDB
sudo dnf install mariadb-server mariadb -y
sudo systemctl start mariadb
sudo systemctl enable mariadb

# Secure MariaDB
sudo mysql_secure_installation <<EOF
y
rootpassword
rootpassword
y
y
y
y
EOF

# Create SQL file and copy local DB to this file
cat <<EOL | sudo tee $SQL_FILE
CREATE TABLE alerte_intensif (
  PRIMARY KEY (alerte_id),
  alerte_id     INT NOT NULL AUTO_INCREMENT,
  alerte_type   ENUM('lit', 'equipement'),
  alerte_description   VARCHAR(255),
  resolu        BOOLEAN,
  date_creation DATE DEFAULT NOW()
);

CREATE TABLE equipement_intensif (
  PRIMARY KEY (equipement_id),
  equipement_id     INT NOT NULL AUTO_INCREMENT,
  type_equipement              VARCHAR(255),
  disponible           BOOLEAN DEFAULT 1,
  date_modification DATE DEFAULT NOW()
);

CREATE TABLE lit_intensif (
  PRIMARY KEY (lit_id),
  lit_id            INT NOT NULL AUTO_INCREMENT,
  disponible        BOOLEAN DEFAULT 1,
  type_lit          ENUM('Standard', 'Pédiatrique', 'Intensif'),
  date_creation     DATE DEFAULT NOW(),
  date_modification DATE DEFAULT NOW(),
  chambre           INT
);

CREATE TABLE patient_intensif (
  PRIMARY KEY (patient_id),
  patient_id        INT NOT NULL AUTO_INCREMENT,
  nom               VARCHAR(255),
  prenom            VARCHAR(255),
  date_naissance    DATE,
  contact           VARCHAR(255),
  adresse           VARCHAR(255),
  actif             BOOLEAN,
  date_creation     DATE DEFAULT NOW(),
  date_modification DATE DEFAULT NOW(),
  lit_id            INT,
  FOREIGN KEY(lit_id) REFERENCES lit(lit_id)
);

CREATE TABLE personnel_medical_intensif (
  PRIMARY KEY (personned_medical_id),
  personned_medical_id int NOT NULL,
  nom                  VARCHAR(255),
  prenom               VARCHAR(255),
  date_naissance       DATE,
  contact              VARCHAR(255),
  adresse              VARCHAR(255),
  specialite           VARCHAR(255),
  date_creation        DATE DEFAULT NOW(),
  date_modification    DATE DEFAULT NOW()
);
EOL

# Connect to MariaDB and create DB and user
sudo mysql -u root -prootpassword <<EOF
CREATE DATABASE $DB_NAME;
CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
GRANT SELECT, LOCK TABLES ON *.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EXIT;
EOF

# Import SQL file into the database
sudo mysql -u root -prootpassword $DB_NAME < $SQL_FILE

# Configure phpMyAdmin
cat <<EOL | sudo tee /etc/httpd/conf.d/phpMyAdmin.conf
Alias /phpmyadmin /usr/share/phpMyAdmin
<Directory /usr/share/phpMyAdmin/>
    AddDefaultCharset UTF-8
    Require all granted
</Directory>
<Directory /usr/share/phpMyAdmin/setup/>
   Require local
</Directory>
<Directory /usr/share/phpMyAdmin/libraries/>
    Require all denied
</Directory>
<Directory /usr/share/phpMyAdmin/templates/>
    Require all denied
</Directory>
<Directory /usr/share/phpMyAdmin/setup/lib/>
    Require all denied
</Directory>
<Directory /usr/share/phpMyAdmin/setup/frames/>
    Require all denied
</Directory>
EOL

# Configure Apache for HTTPS
sudo dnf install mod_ssl -y
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/pki/tls/private/apache-selfsigned.key -out /etc/pki/tls/certs/apache-selfsigned.crt -subj "/C=XX/ST=State/L=City/O=Organization/OU=Unit/CN=soinsintensifs.hopital.lan"
sudo sed -i 's/^#SSLEngine on/SSLEngine on/' /etc/httpd/conf.d/ssl.conf
sudo sed -i 's/^#DocumentRoot "\/var\/www\/html"/DocumentRoot "\/var\/www\/html"/' /etc/httpd/conf.d/ssl.conf
sudo sed -i 's/^#ServerName www.example.com:443/ServerName soinsintensifs.hopital.lan:443/' /etc/httpd/conf.d/ssl.conf
sudo sed -i 's/^SSLCertificateFile \/etc\/pki\/tls\/certs\/localhost.crt/SSLCertificateFile \/etc\/pki\/tls\/certs\/apache-selfsigned.crt/' /etc/httpd/conf.d/ssl.conf
sudo sed -i 's/^SSLCertificateKeyFile \/etc\/pki\/tls\/private\/localhost.key/SSLCertificateKeyFile \/etc\/pki\/tls\/private\/apache-selfsigned.key/' /etc/httpd/conf.d/ssl.conf
sudo systemctl restart httpd

# Configure firewall
sudo firewall-cmd --add-service=mysql --permanent
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --permanent --add-port=3306/tcp
sudo firewall-cmd --permanent --add-port=3306/udp
sudo firewall-cmd --reload

# Create backup script
sudo bash -c "cat > $CRON_FILE" <<EOF
#!/bin/bash
DATE=\$(date +%Y%m%d)
BACKUP_DIR="$BACKUP_DIR"
DB_NAME="$DB_NAME"
DB_USER="$DB_USER"
DB_PASS="$DB_PASS"
mysqldump -u \$DB_USER -p\$DB_PASS \$DB_NAME > \$BACKUP_DIR/backup_\$DATE.sql
EOF
sudo chmod +x $CRON_FILE

# Configure cron jobs
(sudo crontab -u root -l; echo "0 2 * * * $CRON_FILE") | sudo crontab -u root -
(sudo crontab -u root -l; echo "0 3 * * 0 /usr/bin/updatedb") | sudo crontab -u root -

# Allow crontab command only for root and backup_user
sudo visudo <<EOF
root ALL=(ALL) NOPASSWD: /usr/bin/crontab
backup_user ALL=(ALL) NOPASSWD: /usr/bin/crontab
EOF

# Backup necessary files to /backup
sudo cp $SQL_FILE $BACKUP_DIR/
sudo cp $CRON_FILE $BACKUP_DIR/

# Develop a basic PHP application
sudo mkdir -p /var/www/html/soins_intensifs
sudo chown -R apache:apache /var/www/html/soins_intensifs
cat <<EOL | sudo tee /var/www/html/soins_intensifs/index.php
<?php
\$servername = "localhost";
\$username = "admin"; // Replace with your DB username
\$password = "rootpassword"; // Replace with your DB password
\$dbname = "soins_intensifs"; // Replace with your DB name

// Create connection
\$conn = new mysqli(\$servername, \$username, \$password, \$dbname);

// Check connection
if (\$conn->connect_error) {
    die("Connection failed: " . \$conn->connect_error);
}

echo "Connexion réussie à la base de données";
?>
EOL

# Test the web page with Lynx
lynx https://soinsintensifs.hopital.lan/soins_intensifs

# Cleanup PHP test file
sudo rm /var/www/html/soins_intensifs/index.php

# Completion message
echo "Setup completed successfully!"

# Add copies to GitHub
git clone $GIT_REPO
cp $CRON_FILE HopitalG3/
cp $SQL_FILE HopitalG3/

cd HopitalG3/
git add .
git commit -m "Add backup scripts and database"
git push origin main

# Create rsync backup script
cat <<EOL | sudo tee /backup/rsync_backup_script.sh
#!/bin/bash

# Variables
BACKUP_DIR="$BACKUP_DIR"
SOURCE_DIR="$SOURCE_DIR"
DEST_DIR="$BACKUP_DIR/backup_\$(date +%Y%m%d)"

# Create backup directory
mkdir -p \$DEST_DIR

# Sync files
rsync -av --delete \$SOURCE_DIR/ \$DEST_DIR/

# Remove old backups 
find \$BACKUP_DIR -type d -mtime +7 -exec rm -rf {} \;

echo "Backup completed successfully!"
EOL

sudo chmod +x /backup/rsync_backup_script.sh

# Configure cron job for rsync backup
(sudo crontab -u root -l; echo "0 2 * * * /backup/rsync_backup_script.sh") | sudo crontab -u root -

# Final completion message
echo "Rsync backup setup completed successfully!"
