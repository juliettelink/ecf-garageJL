# creation de la base de donnéee du garage VParrot
drop database if exists garagevpjl;
create database garagevpjl;


#table opinion
drop table if exists opinion;
CREATE TABLE opinion(
	opinion_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nameClient VARCHAR (50) NOT NULL,
    comment VARCHAR (250) NOT NULL,
	note INT NOT NULL,
    date DATE NOT NULL
);

#table openingTime
drop table if exists openingTime;
CREATE TABLE openingTime(
        openingTime_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
        day VARCHAR (50) NOT NULL,
        morningOpen VARCHAR (50) NOT NULL,
        morningClose VARCHAR (50) NOT NULL,
        afternoonOpen VARCHAR (50) NOT NULL,
        afertnooClose VARCHAR (50) NOT NULL
);

# table Car
drop table if exists car;
CREATE TABLE car(
        car_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        model VARCHAR (50) NOT NULL,
        year INT NOT NULL,
        price VARCHAR(50) NOT NULL,
        kilometer VARCHAR (100) NOT NULL,
        full VARCHAR(50) NOT NULL,
        color VARCHAR (50) NOT NULL
);

#table service
drop table if exists service;
CREATE TABLE service(
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

#table user
drop table if exists user;
CREATE TABLE user(
        user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        name VARCHAR (50) NOT NULL,
        firstname VARCHAR (50) NOT NULL,
        mail VARCHAR (50) NOT NULL,
        passeword VARCHAR (50) NOT NULL,
        openingTime_id INT NOT NULL,
        service_id INT NOT NULL,
        role_id INT NOT NULL,
	    CONSTRAINT user_OpeningTime_FK FOREIGN KEY (openingTime_id) REFERENCES openingTime(openingTime_id),
	    CONSTRAINT user_Service0_FK FOREIGN KEY (service_id) REFERENCES service(service_id),
        CONSTRAINT user_role1_FK FOREIGN KEY (role_id) REFERENCES role(role_id)
);

#table picture
drop table if exists picture;
CREATE TABLE picture(
        picture_id INT PRIMARY KEY AUTO_INCREMENT  NOT NULL ,
        is_principal BOOL NOT NULL ,
        image1 VARCHAR (250) NOT NULL ,
        image2 VARCHAR (250) NOT NULL ,
        image3 VARCHAR (250) NOT NULL ,
        car_id INT NOT NULL,
    	CONSTRAINT picture_car_FK FOREIGN KEY (car_id) REFERENCES car(car_id)
);


    	

# table form
drop table if exists form;
CREATE TABLE form(
        form_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        name VARCHAR (50) NOT NULL,
        surname VARCHAR (50) NOT NULL,
        mail VARCHAR (50) NOT NULL,
        modele VARCHAR (50) NOT NULL,
        subject VARCHAR (50) NOT NULL,
        message VARCHAR (250) NOT NULL,
        date DATE NOT null
);

# table user_car (add modify delete)
drop table if exists user_car;
CREATE TABLE user_car(
        user_id INT NOT NULL,
        car_id  INT NOT null,
	CONSTRAINT user_car_PK PRIMARY KEY (user_id,car_id),
	CONSTRAINT user_car_role_FK FOREIGN KEY (user_id) REFERENCES role(user_id),
	CONSTRAINT user_car_car0_FK FOREIGN KEY (car_id) REFERENCES car(car_id)
);


#table user_opinion (delete add create)
drop table if exists user_opinion;
CREATE TABLE user_opinion(
        user_id INT NOT NULL,
        opinion_id INT NOT null,
	CONSTRAINT user_opinion_PK PRIMARY KEY (user_id,opinion_id),
	CONSTRAINT user_opinion_role_FK FOREIGN KEY (user_id) REFERENCES role(user_id),
	CONSTRAINT user_opinion_opinion0_FK FOREIGN KEY (opinion_id) REFERENCES opinion(opinion_id)
);

#table car_form (fill)
drop table if exists car_form;
CREATE TABLE car_form(
        form_id INT NOT NULL,
        car_id  INT NOT null,
	CONSTRAINT car_form_PK PRIMARY KEY (form_id,car_id),
	CONSTRAINT car_form_form_FK FOREIGN KEY (form_id) REFERENCES form(form_id),
	CONSTRAINT car_form_car0_FK FOREIGN KEY (car_id) REFERENCES car(car_id)
);



#INSERER LES DONNEES

# pour la table car 
insert into car (model, year, price, kilometer, full, color) values
('PORCHE 997 Turbo', 2022, '98521,45€','108 569km', 'Essence', 'rouge');

insert into car (model, year, price, kilometer, full, color) values
('PEUGEOT RCZ', 2012, '15 630€', '62 809km', 'Diesel', 'noir'),
('PEUGEOT 2008', 2017, '86 990€', '32 330km', 'Essence', 'bleu'),
('RENAULT TWINGO III', 2021, '13 952€', '235 253km', 'Essence', 'blanc'),
('PEUGEOT Partner Fourgon', 2017, '154 523€', '152 556km', 'Diesel', 'blanc'),
('FIAT DOBLO CARGO', 2020, '147 844€', '685 658km', 'Diesel', 'jaune'),
('RENAULT Trafic Fourgon', 2018, '311 562€', '15 785km', 'Diesel', 'gris'),
('CITROEN C3', 2022, '355 623€', '9 556km', 'Essence', 'orange');

#insert into table picture
insert into picture(is_principal, image1, image2, image3, car_id) values
('true', '00car.png', '001car.png', '002car.png', 1);

insert into picture(is_principal, image1, image2, image3, car_id) values
('true', '01car.png', '', '', 2),
('true', '02car.png', '', '', 3),
('true', '03car.png', '', '', 4),
('true', '04car.png', '', '', 5),
('true', '05car.png', '', '', 6),
('true', '06car.png', '', '', 7),
('true', '07car.png', '', '', 8);

#insert into service 
insert into service(service, description, image)  values
('Climatisation', 'Nous réalisons l entretier, la recharge et la réparation de la clim', 'clim.jpg'), 
('Vidange', 'Filtre à huile, du filtre à air, filtre habitacle et filtre à gasoil', 'vidange.jpg'),
('Carrossierie et tôlerie', 'Remplacement, décabossage, redressage, passage au marbre, réparation de choc', 'carosserie.jpg'),
('Distribution', 'Changement de la courroie de distribution', 'distribution.jpg'),
('Vitrage et phares', 'Réparations de votre pare-brise, glaces latérales, lunette arrière ainsi que la restauration de vos phares', 'vitrage.jpg');


#insert into openingTime 
insert into openingtime(day, morningOpen, morningClose, afternoonOpen, afertnooClose) values
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


# ajouter les mot de passe par php
# insert into user 
insert into user (name, firstname, mail, role_id) values
('Parrot', 'Vincent', 'vparrot@gmail.com', 1),
('PLantin', 'Jeanne', 'JPlantin@gmail.com', 2),
('Cracos', 'Jean', 'JCracos@gmail.com', 2),
('Benard', 'Marc', 'MBenard@gmail.com', 2),
('Boutin', 'Gerard', 'GBoutin@gmail.com', 2);

# inter into opinion
insert into opinion(nameClient, comment, note, date) values
('Jeanne Boulin', 'Service rapide et efficace, je recommande', 5, '2020-09-24'),
('Pierre Rondin', 'Je suis tombé au mauvias moment, il y avait beaucoup d\'attente, mais ils ont su me faire pacienté avec un petit café', 4, '2021-03-12'),
('Sandrine Chalin', 'J\'ai acheté une voiture d\'occasion, je suis très satisfaite', 5, '2022-06-15'),
('Jean Rrucj', 'Très professionnel et d\'une grande humanité', 4, '2022-12-18');
delete from opinion 