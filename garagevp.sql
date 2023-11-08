drop database if exists garagevpjl;
create database garagevpjl;


#table opinion
drop table if exists opinions;
CREATE TABLE opinions(
	opinion_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        nameClient VARCHAR (50) NOT NULL,
        comment VARCHAR (250) NOT NULL,
	note INT NOT NULL,
        date DATE NOT NULL
);

#table openingTimes
drop table if exists openingTime;
CREATE TABLE openingTimes(
        openingTime_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
        day VARCHAR (50) NOT NULL,
        morningOpen VARCHAR (50) NOT NULL,
        morningClose VARCHAR (50) NOT NULL,
        afternoonOpen VARCHAR (50) NOT NULL,
        afternoonClose VARCHAR (50) NOT NULL
);


# table Cars
drop table if exists cars;
CREATE TABLE cars(
        car_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        model VARCHAR (50) NOT NULL,
        year INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
   	kilometer INT NOT NULL,
        full VARCHAR(50) NOT NULL,
        color VARCHAR (50) NOT NULL
);

#table services
drop table if exists services;
CREATE TABLE services(
        service_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        service VARCHAR (30) NOT NULL,
        description VARCHAR (250) NOT NULL,
        image VARCHAR (250) NOT NULL
);

# table role
drop table if exists role;
CREATE TABLE role(
        role_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        name VARCHAR(25)
);

#table users
drop table if exists users;
CREATE TABLE users(         
        mail_id VARCHAR(50) PRIMARY KEY NOT NULL,
        name VARCHAR (50) NOT NULL,
        firstname VARCHAR (50) NOT NULL,
        password VARCHAR (250) NOT NULL,
        openingTime_id INT NOT NULL,
        service_id INT NOT NULL,
	CONSTRAINT user_OpeningTime_FK FOREIGN KEY (openingTime_id) REFERENCES openingTimes(openingTime_id),
	CONSTRAINT user_Service0_FK FOREIGN KEY (service_id) REFERENCES services(service_id)
);

#table pictures
drop table if exists pictures;
CREATE TABLE pictures(
        picture_id INT PRIMARY KEY AUTO_INCREMENT  NOT NULL ,
        image1 VARCHAR (250) NOT NULL ,
        image2 VARCHAR (250) NOT NULL ,
        image3 VARCHAR (250) NOT NULL ,
        car_id INT NOT NULL,
CONSTRAINT picture_car_FK FOREIGN KEY (car_id) REFERENCES cars(car_id)
);

	

# table forms
drop table if exists forms;
CREATE TABLE forms(
        form_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        name VARCHAR (50) NOT NULL,
        surname VARCHAR (50) NOT NULL,
        mail VARCHAR (50) NOT NULL,
        model VARCHAR (50) NOT NULL,
        subject VARCHAR (50) NOT NULL,
        message VARCHAR (250) NOT NULL,
        date DATE NOT null
);

alter table forms 	
	add foreign key (model) references cars(model);


# table users-role (possess)
drop table if exists users_role;
CREATE TABLE users_role(
        role_id INT NOT NULL ,
        mail_id VARCHAR(50) NOT null,
        CONSTRAINT user_role_PK PRIMARY KEY (role_id,mail_id),
		CONSTRAINT user_role_role_FK FOREIGN KEY (role_id) REFERENCES role(role_id),
		CONSTRAINT user_role_user0_FK FOREIGN KEY (mail_id) REFERENCES users(mail_id)
);

# table users_cars (add modify delete)
drop table if exists users_cars;
CREATE TABLE users_cars(
        mail_id VARCHAR(50) NOT null,
        car_id  INT NOT null,
	CONSTRAINT user_car_PK PRIMARY KEY (mail_id,car_id),
	CONSTRAINT user_car_user_FK FOREIGN KEY (mail_id) REFERENCES users(mail_id),
	CONSTRAINT user_car_car0_FK FOREIGN KEY (car_id) REFERENCES cars(car_id)
);


#table users_opinions (delete add create)
drop table if exists users_opinions;
CREATE TABLE users_opinions(
        mail_id VARCHAR(50) NOT null,
        opinion_id INT NOT null,
	CONSTRAINT user_opinion_PK PRIMARY KEY (mail_id,opinion_id),
	CONSTRAINT user_opinion_user_FK FOREIGN KEY (mail_id) REFERENCES users(mail_id),
	CONSTRAINT user_opinion_opinion0_FK FOREIGN KEY (opinion_id) REFERENCES opinions(opinion_id)
);

#table cars_forms (fill)
drop table if exists cars_forms;
CREATE TABLE cars_forms(
        form_id INT NOT NULL,
        car_id  INT NOT null,
	CONSTRAINT car_form_PK PRIMARY KEY (form_id,car_id),
	CONSTRAINT car_form_form_FK FOREIGN KEY (form_id) REFERENCES forms(form_id),
	CONSTRAINT car_form_car0_FK FOREIGN KEY (car_id) REFERENCES cars(car_id)
);



#INSERER LES DONNEES

# pour la table cars 
insert into cars (model, year, price, kilometer, full, color) values
('PORCHE 997 Turbo', 2022, '98521,45','108569', 'Essence', 'rouge');

insert into cars (model, year, price, kilometer, full, color) values
('PEUGEOT RCZ', 2012, '15630', '62809', 'Diesel', 'noir'),
('PEUGEOT 2008', 2017, '86990', '32330', 'Essence', 'bleu'),
('RENAULT TWINGO III', 2021, '13952', '235253', 'Essence', 'blanc'),
('PEUGEOT Partner Fourgon', 2017, '154523', '152556', 'Diesel', 'blanc'),
('FIAT DOBLO CARGO', 2020, '147844', '685658', 'Diesel', 'jaune'),
('RENAULT Trafic Fourgon', 2018, '311562', '15785', 'Diesel', 'gris'),
('CITROEN C3', 2022, '355623', '9556', 'Essence', 'orange');

#insert into table pictures
insert into pictures(is_principal, image1, image2, image3, car_id) values
('true', '00car.png', '001car.png', '002car.png', 1);

insert into pictures(is_principal, image1, image2, image3, car_id) values
('true', '01car.png', '', '', 2),
('true', '02car.png', '', '', 3),
('true', '03car.png', '', '', 4),
('true', '04car.png', '', '', 5),
('true', '05car.png', '', '', 6),
('true', '06car.png', '', '', 7),
('true', '07car.png', '', '', 8);

#insert into services 
insert into services(service, description, image)  values
('Climatisation', 'Nous réalisons l entretier, la recharge et la réparation de la clim', 'clim.jpg'), 
('Vidange', 'Filtre à huile, du filtre à air, filtre habitacle et filtre à gasoil', 'vidange.jpg'),
('Carrossierie et tôlerie', 'Remplacement, décabossage, redressage, passage au marbre, réparation de choc', 'carosserie.jpg'),
('Distribution', 'Changement de la courroie de distribution', 'distribution.jpg'),
('Vitrage et phares', 'Réparations de votre pare-brise, glaces latérales, lunette arrière ainsi que la restauration de vos phares', 'vitrage.jpg');


#insert into openingTimes 
insert into openingtimes(day, morningOpen, morningClose, afternoonOpen, afternoonClose) values
('lundi', '8h45', '12h00', '14h00', '18h00'),
('mardi', '8h45', '12h00', '14h00', '18h00'),
('mercredi', '8h45', '12h00', '14h00', '18h00'),
('jeudi', '8h45', '12h00', '14h00', '18h00'),
('vendredi', '8h45', '12h00', '14h00', '18h00'),
('samedi', '8h45', '12h00', 'fermé', 'fermé'),
('dimanche', 'fermé', 'fermé', 'fermé', 'fermé');


# insert into role
insert into role(name) values
('administrator'),
('employe');



# insert into users 
insert into users (mail_id, name, firstname,password) values
('vparrot@gmail.com', 'Parrot', 'Vincent','$2y$10$QgEwAzJW9Dy/BX/0Wyd16.VWSOXDUFnKlut6w8IhO0R43qqwUWXLW'),
('JPlantin@gmail.com', 'PLantin', 'Jeanne','$2y$10$piz7lig3ShoXoqmSHiNKXuKVPNAEmhVQJ.AbcjzxZ1iJ0IZZG5Igi'),
('JCracos@gmail.com', 'Cracos', 'Jean','$2y$10$JGkudV0svEnRDRgrPP3gVu8UcSlB8eXcyv/YdcmuLWEZ54lIaRrlm'),
('MBenard@gmail.com','Benard', 'Marc','$2y$10$SFSkz5EZVGMo2t0Ol818oOUT1dNaBvDV/U2sPDYg7Lg77FRw.wxgq'),
('GBoutin@gmail.com','Boutin', 'Gerard','$2y$10$IiZFshC4WpbXrTmsKrUwS.0jN8W4UaHOa1vI02HDVWY.OfvxxveuW');


# insert into opinions
insert into opinions(nameClient, comment, note, date) values
('Jeanne Boulin', 'Service rapide et efficace, je recommande', 5, '2020-09-24'),
('Pierre Rondin', 'Je suis tombé au mauvias moment, il y avait beaucoup d\'attente, mais ils ont su me faire pacienté avec un petit café', 4, '2021-03-12'),
('Sandrine Chalin', 'J\'ai acheté une voiture d\'occasion, je suis très satisfaite', 5, '2022-06-15'),
('Jean Rrucj', 'Très professionnel et d\'une grande humanité', 4, '2022-12-18');
delete from opinions 


# insert into users-role 
insert into users_role(role_id, mail_id) values
(1, 'vparrot@gmail.com'),
(2, 'JPlantin@gmail.com'),
(2, 'JCracos@gmail.com'),
(2, 'MBenard@gmail.com'),
(2, 'GBoutin@gmail.com');



# REQUETE INTEGRER A MON PHP
# model de forms correspond au model dans cars
alter table forms 	
	add foreign key (model) references cars(model);

# DEBUT DE REQUETE POUR LES VOITURES
# requete SQL  relier cars et pictures avec ordre id inversé
SELECT c.*, p.* 
FROM cars c 
INNER JOIN pictures p 
ON c.car_id = p.car_id 
ORDER BY c.car_id DESC;


# requete pour obtenir la liste des modéle de voitures unique
SELECT DISTINCT model FROM cars;

# requete pour obtenir le nombre total de lignes dans la tables cars (nombre de voitures)
SELECT COUNT(*) as total
          FROM cars;
         
#requête pour obtenir les données d'un voiture (car_id) et de ses images associées
SELECT c.*, p.* 
          FROM cars c 
          INNER JOIN pictures p ON c.car_id = p.car_id 
          WHERE c.car_id = :id;


# requête qui permet d'obtenir toutes les images associées en fonction de id (car_id)
SELECT * FROM pictures WHERE car_id = :id;

# requête pour effectuer des modifications d'une voiture dans la bdd
UPDATE cars SET model = :model, year = :year, price = :price, kilometer = :kilometer,
       full = :full, color = :color WHERE car_id = :id
       
# requête qui met à jour une image accocié à une voiture dans la bdd
UPDATE pictures SET image1 = :image1 WHERE car_id = :id;


# requête pour supprimer les images associée à une voiture (car-id)
DELETE FROM pictures WHERE car_id = :car_id;

# requête pour supprimer une voiture de la BDD
DELETE FROM cars WHERE car_id = :car_id;


# DEBUT REQUETE POUR LE FORMULAIRE (forms)
# requête pour prend tous les informations de la table forms 
SELECT * FROM forms

# requête pour supprimer un formulaire spécifique (form_id) de bdd
DELETE FROM forms WHERE form_id = :id;



# DEBUT REQUETE POUR LES HORAIRES (openingTimes)
# requête qui permet de récupere les infomations specifique (openingTime_id)
SELECT * FROM openingTimes WHERE openingTime_id=:id;

# DEBUT REQUETE AVIS (opinions)
# Requete qui pemert d'afficher les derniers avis dans l'appli du site limité à 10
SELECT * FROM opinions ORDER BY opinion_id DESC LIMIT 10;

# Requete pour récuper un avis spécifique en fonciton de id (opinion_id)
SELECT * FROM opinions WHERE opinion_id = :id;

# Requete pour supprimer un avis spécifique en fonction de l'id
DELETE FROM opinions WHERE opinion_id = :id;


#POUR LES SERVICES 
SELECT * FROM services WHERE service_id=:id;

DELETE FROM services WHERE service_id = :id;

#Requête pour effectuer des modification spécifique sur un id dans la bdd
UPDATE `services` SET `service` = :service, "
        ."`description` = :description, "
        ."image = :image WHERE `service_id` = :id;



# REQUETE POUR LES UTILISATUERS (users) et role (users-role)
SELECT * FROM users;

# Requête pour récuperer des informations sur un utilisateur et son role
# jointure role_id et mail_id
SELECT u.*, r.name AS role_name
                            FROM users u
                            INNER JOIN users_role ur ON u.mail_id = ur.mail_id
                            INNER JOIN role r ON ur.role_id = r.role_id
                            WHERE u.mail_id = :email;


DELETE FROM users_role WHERE mail_id = :email;



DELETE FROM users WHERE mail_id = :email;

SELECT role_id FROM role WHERE name = :role

SELECT COUNT(*) FROM users WHERE mail_id = :email





