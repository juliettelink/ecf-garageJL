#création de table employé
CREATE TABLE employe(
    employe_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(25) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(50) NOT NULL,
    role VARCHAR(25) NOT NULL
);

#création de la table horaire
CREATE TABLE horaire(
    horaire_id INT AUTO_INCREMENT PRIMARY KEY,
    lundi_matin VARCHAR(10),
    lundi_ap VARCHAR(10),
    mardi_matin VARCHAR(10),
    mardi_ap VARCHAR(10),
    mercredi_matin VARCHAR(10),
    mercredi_ap VARCHAR(10),
    jeudi_matin VARCHAR(10),
    jeudi_ap VARCHAR(10),
    vendredi_matin VARCHAR(10),
    vendredi_ap VARCHAR(10),
    samedi_matin VARCHAR(10),
    samedi_ap VARCHAR(10),
    dimanche_matin VARCHAR(10),
    dimanche_ap VARCHAR(10)
);

# création de la table avis
CREATE TABLE avis(
    avis_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    commentaire VARCHAR(250) NOT NULL ,
    note VARCHAR(25)
);


# création de la table services
CREATE TABLE service(
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL ,
    description VARCHAR(250) NOT NULL,
    photo VARCHAR(250)
);

# création de la table formulaire
CREATE TABLE formulaire(
    formulaire_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    GSM VARCHAR(20),
    mail VARCHAR(50),
    commentaire VARCHAR(250)
);

# création de la table voiture
CREATE TABLE voiture(
    voiture_id INT AUTO_INCREMENT PRIMARY KEY,
    photo VARCHAR(200),
    modele VARCHAR(50),
    prix INT,
    kilometre VARCHAR(50),
    annee INT,
    description VARCHAR(250)
);

#création de la table employé_avis (modérer)
CREATE TABLE employe_avis(
    avis_id INT,
    employe_id INT,
    PRIMARY KEY (avis_id, employe_id),
    CONSTRAINT moderer_Avis_FK FOREIGN KEY (avis_id) REFERENCES avis(avis_id),
	CONSTRAINT moderer_Employe0_FK FOREIGN KEY (employe_id) REFERENCES employe(employe_id)
);

# création de la table employé_voiture (ajouter)
CREATE TABLE employe_voiture(
    voiture_id INT,
    employe_id INT,
    PRIMARY KEY (voiture_id, employe_id),
    CONSTRAINT Ajouter_Voiture0_FK FOREIGN KEY (voiture_id) REFERENCES voiture(voiture_id),
	CONSTRAINT Ajouter_Employe0_FK FOREIGN KEY (employe_id) REFERENCES employe(employe_id)
);

# création de la table fomulaire_voiture (remplir)
CREATE TABLE formulaire_voiture(
    voiture_id INT,
    formulaire_id INT,
    PRIMARY KEY (voiture_id, formulaire_id),
    CONSTRAINT Remplir_Voiture_FK FOREIGN KEY (voiture_id) REFERENCES voiture(voiture_id),
    CONSTRAINT Remplir_Formulaire_FK FOREIGN KEY (formulaire_id) REFERENCES formulaire(formulaire_id)
);

# création de la table avis_service (déposer)
CREATE TABLE avis_service(
    avis_id INT,
    service_id INT,
    PRIMARY KEY (avis_id, service_id),
    CONSTRAINT deposer_Avis_FK FOREIGN KEY (avis_id) REFERENCES avis(avis_id),
	CONSTRAINT deposer_Services0_FK FOREIGN KEY (service_id) REFERENCES service(service_id)
);

# création de la table formulaire_service(fournir)
CREATE TABLE fomulaire_service(
    formulaire_id INT,
    service_id INT,
    PRIMARY KEY (formulaire_id, service_id),
    CONSTRAINT fournir_Service_FK FOREIGN KEY (service_id) REFERENCES service(service_id),
	CONSTRAINT fournir_Formulaire0_FK FOREIGN KEY (formulaire_id) REFERENCES formulaire(formulaire_id)
);
