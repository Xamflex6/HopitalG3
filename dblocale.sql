-- Création par Dowson --

CREATE TABLE alerte_intensif (
  PRIMARY KEY (alerte_id),
  alerte_id     INT NOT NULL AUTO_INCREMENT,
  alerte_type   ENUM('lit', 'equipement'),
  alerte_description   VARCHAR(255),
  resolu        BOOLEAN,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE equipement_intensif (
  PRIMARY KEY (equipement_id),
  equipement_id     INT NOT NULL AUTO_INCREMENT,
  type_equipement              VARCHAR(255),
  disponible           BOOLEAN DEFAULT 1,
  date_modification DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE lit_intensif (
  PRIMARY KEY (lit_id),
  lit_id            INT NOT NULL AUTO_INCREMENT,
  disponible        BOOLEAN DEFAULT 1,
  type_lit          ENUM('Standard', 'Pédiatrique', 'Intensif'),
  date_creation     DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_modification DATETIME DEFAULT CURRENT_TIMESTAMP,
  chambre           INT
);

CREATE TABLE patient_intensif (
  PRIMARY KEY (patient_id),
  patient_id        INT NOT NULL AUTO_INCREMENT,
  nom               VARCHAR(255),
  prenom            VARCHAR(255),
  date_naissance    DATETIME,
  contact           VARCHAR(255),
  adresse           VARCHAR(255),
  actif             BOOLEAN,
  date_creation     DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_modification DATETIME DEFAULT CURRENT_TIMESTAMP,
  lit_id            INT,
  FOREIGN KEY(lit_id) REFERENCES lit_intensif(lit_id)
);

CREATE TABLE personnel_medical_intensif (
  PRIMARY KEY (personned_medical_id),
  personned_medical_id int NOT NULL,
  nom                  VARCHAR(255),
  prenom               VARCHAR(255),
  date_naissance       DATETIME,
  contact              VARCHAR(255),
  adresse              VARCHAR(255),
  specialite           VARCHAR(255),
  date_creation        DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_modification    DATETIME DEFAULT CURRENT_TIMESTAMP
);  