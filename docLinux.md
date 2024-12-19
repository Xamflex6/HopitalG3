# Linux
## Plan de partitionnement

###Données

- /home 

Point de montage : /home

Périphérique : VMware Virtual NVMe Disk 1 (nvme0n1)
Capacité souhaitée : 2 Go
Type de périphérique : LVM
Système de fichiers : ext4

- /backup 

Point de montage : /backup
Périphérique : Msft Virtual Disk (sda)
Capacité souhaitée : 10 Go
Type de périphérique : LVM
Système de fichiers : xfs
Nom : sda3

- /srv 

Point de montage : /srv
Périphérique : VMware Virtual NVMe Disk 1 (nvme0n1)
Capacité souhaitée : 6 Go
Type de périphérique : LVM
Système de fichiers : ext4

###Système

- / (root) 

Point de montage : /
Périphérique : VMware Virtual NVMe Disk 1 (nvme0n1)
Capacité souhaitée : 10 Go
Type de périphérique : LVM (Logical Volume Management)
Système de fichiers : ext4


- /var

Point de montage : /var
Périphérique : VMware Virtual NVMe Disk 1 (nvme0n1)
Capacité souhaitée : 6 Go
Type de périphérique : LVM
Système de fichiers : ext4



- /tmp 

Point de montage : /tmp
Périphérique : VMware Virtual NVMe Disk 1 (nvme0n1)
Capacité souhaitée : 1024 Mo (1 Go)
Type de périphérique : LVM
Système de fichiers : ext4


- /boot 

Point de montage : /boot
Périphérique : VMware Virtual NVMe Disk 1 (nvme0n1p1)
Capacité souhaitée : 1024 Mo (1 Go)
Type de périphérique : Partition standard
Système de fichiers : ext4


- swap 

Point de montage : swap
Périphérique : VMware Virtual NVMe Disk 1 (nvme0n1p2)
Capacité souhaitée : 2 Go
Type de périphérique : Partition standard
Système de fichiers : swap


## Plan de sauvegarde

###Objectif

Ce plan de sauvegarde vise à assurer la sécurité et la disponibilité des données critiques du serveur en automatisant les sauvegardes quotidiennes des répertoires importants. Les sauvegardes seront stockées dans une partition dédiée et seront conservées pendant une semaine.

###Répertoires à Sauvegarder

- /etc
- /srv
- /var
- /home
- /root

###Fréquence des Sauvegardes

Chaque jour à 2h du matin.

###Durée de Conservation des Sauvegardes

Les sauvegardes seront conservées pendant une semaine.

###Emplacement de Stockage

Les sauvegardes seront stockées dans la partition /backup.

###Capacité du Support de Sauvegarde

La capacité de la partition /backup doit être suffisante pour stocker les sauvegardes pendant une semaine.

###Durée Maximale de la Sauvegarde

La sauvegarde doit durer au maximum 5-10 minutes.

###Durée Maximale de Restauration

La restauration d'un fichier ou d'un système de fichiers doit prendre au maximum 20 minutes.

###Méthode de Sauvegarde

Sauvegarde incrémentielle avec rsync pour ne mettre à jour que les fichiers modifiés, réduisant ainsi le temps de sauvegarde et l'espace de stockage nécessaire.

###Support de Sauvegarde

Une partition dédiée /backup sur le serveur.

###Automatisation des Sauvegardes

Les sauvegardes seront automatisées chaque nuit à 2h grâce à crontab. Il sera également possible de lancer les sauvegardes manuellement.

## Implémentation DNS
soins_intensifs.hopital.lan

## Installation et configuration des services

- FTP : Configuration de SFTP avec chroot pour les utilisateurs.
- HTTPD : Installation et configuration d'Apache HTTP Server avec SSL.
- MariaDB : Installation et configuration de MariaDB.
- PHPMyAdmin : Installation et configuration de PHPMyAdmin.
- ClamAV : Installation et configuration de l'antivirus ClamAV.
- Fail2Ban : Installation et configuration de Fail2Ban pour la protection contre les attaques par force brute.
- Fstab : Configuration des options de montage pour les partitions.
- SELINUX : Sécurisation des services.
- Apache : Accès au serveur web pour les utilisateurs 

