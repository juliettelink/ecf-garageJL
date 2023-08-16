drop database if exists garagevpjl;

create database garagevpjl;

#table opinion drop table if exists opinions;

CREATE TABLE
    opinions(
        opinion_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        nameClient VARCHAR (50) NOT NULL,
        comment VARCHAR (250) NOT NULL,
        note INT NOT NULL,
        date DATE NOT NULL
    );

#table openingTimes drop table if exists openingTime;

CREATE TABLE
    openingTimes(
        openingTime_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        day VARCHAR (50) NOT NULL,
        morningOpen VARCHAR (50) NOT NULL,
        morningClose VARCHAR (50) NOT NULL,
        afternoonOpen VARCHAR (50) NOT NULL,
        afertnooClose VARCHAR (50) NOT NULL
    );

# table Cars drop table if exists cars;

CREATE TABLE
    cars(
        car_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        model VARCHAR (50) NOT NULL,
        year INT NOT NULL,
        price VARCHAR(50) NOT NULL,
        kilometer VARCHAR (100) NOT NULL,
        full VARCHAR(50) NOT NULL,
        color VARCHAR (50) NOT NULL
    );

#table services drop table if exists services;

CREATE TABLE
    services(
        service_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        service VARCHAR (30) NOT NULL,
        description VARCHAR (250) NOT NULL,
        image VARCHAR (250) NOT NULL
    );

# table role drop table if exists role;

CREATE TABLE
    role(
        role_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        name VARCHAR(25)
    );

#table users drop table if exists users;

CREATE TABLE
    users(
        mail_id VARCHAR(50) PRIMARY KEY NOT NULL,
        name VARCHAR (50) NOT NULL,
        firstname VARCHAR (50) NOT NULL,
        passeword VARCHAR (50) NOT NULL,
        openingTime_id INT NOT NULL,
        service_id INT NOT NULL,
        CONSTRAINT user_OpeningTime_FK FOREIGN KEY (openingTime_id) REFERENCES openingTimes(openingTime_id),
        CONSTRAINT user_Service0_FK FOREIGN KEY (service_id) REFERENCES services(service_id)
    );

#table pictures drop table if exists pictures;

CREATE TABLE
    pictures(
        picture_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        is_principal BOOL NOT NULL,
        image1 VARCHAR (250) NOT NULL,
        image2 VARCHAR (250) NOT NULL,
        image3 VARCHAR (250) NOT NULL,
        car_id INT NOT NULL,
        CONSTRAINT picture_car_FK FOREIGN KEY (car_id) REFERENCES cars(car_id)
    );

# table forms drop table if exists forms;

CREATE TABLE
    forms(
        form_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        name VARCHAR (50) NOT NULL,
        surname VARCHAR (50) NOT NULL,
        mail VARCHAR (50) NOT NULL,
        modele VARCHAR (50) NOT NULL,
        subject VARCHAR (50) NOT NULL,
        message VARCHAR (250) NOT NULL,
        date DATE NOT null
    );

# table users-role (possess) drop table if exists users_role;

CREATE TABLE
    users_role(
        role_id INT NOT NULL,
        mail_id VARCHAR(50) NOT null,
        CONSTRAINT user_role_PK PRIMARY KEY (role_id, mail_id),
        CONSTRAINT user_role_role_FK FOREIGN KEY (role_id) REFERENCES role(role_id),
        CONSTRAINT user_role_user0_FK FOREIGN KEY (mail_id) REFERENCES users(mail_id)
    );

# table users_cars (add modify delete)
drop table if exists users_cars;

CREATE TABLE
    users_cars(
        mail_id VARCHAR(50) NOT null,
        car_id INT NOT null,
        CONSTRAINT user_car_PK PRIMARY KEY (mail_id, car_id),
        CONSTRAINT user_car_user_FK FOREIGN KEY (mail_id) REFERENCES users(mail_id),
        CONSTRAINT user_car_car0_FK FOREIGN KEY (car_id) REFERENCES cars(car_id)
    );

#table users_opinions (delete add create)
drop table
    if exists users_opinions;

CREATE TABLE
    users_opinions(
        mail_id VARCHAR(50) NOT null,
        opinion_id INT NOT null,
        CONSTRAINT user_opinion_PK PRIMARY KEY (mail_id, opinion_id),
        CONSTRAINT user_opinion_user_FK FOREIGN KEY (mail_id) REFERENCES users(mail_id),
        CONSTRAINT user_opinion_opinion0_FK FOREIGN KEY (opinion_id) REFERENCES opinions(opinion_id)
    );

#table cars_forms (fill) drop table if exists cars_forms;

CREATE TABLE
    cars_forms(
        form_id INT NOT NULL,
        car_id INT NOT null,
        CONSTRAINT car_form_PK PRIMARY KEY (form_id, car_id),
        CONSTRAINT car_form_form_FK FOREIGN KEY (form_id) REFERENCES forms(form_id),
        CONSTRAINT car_form_car0_FK FOREIGN KEY (car_id) REFERENCES cars(car_id)
    );

#INSERER LES DONNEES
# pour la table cars 
insert into
    cars (
        model,
        year,
        price,
        kilometer,
        full,
        color
    )
values (
        'PORCHE 997 Turbo',
        2022,
        '98521,45€',
        '108 569km',
        'Essence',
        'rouge'
    );

insert into
    cars (
        model,
        year,
        price,
        kilometer,
        full,
        color
    )
values (
        'PEUGEOT RCZ',
        2012,
        '15 630€',
        '62 809km',
        'Diesel',
        'noir'
    ), (
        'PEUGEOT 2008',
        2017,
        '86 990€',
        '32 330km',
        'Essence',
        'bleu'
    ), (
        'RENAULT TWINGO III',
        2021,
        '13 952€',
        '235 253km',
        'Essence',
        'blanc'
    ), (
        'PEUGEOT Partner Fourgon',
        2017,
        '154 523€',
        '152 556km',
        'Diesel',
        'blanc'
    ), (
        'FIAT DOBLO CARGO',
        2020,
        '147 844€',
        '685 658km',
        'Diesel',
        'jaune'
    ), (
        'RENAULT Trafic Fourgon',
        2018,
        '311 562€',
        '15 785km',
        'Diesel',
        'gris'
    ), (
        'CITROEN C3',
        2022,
        '355 623€',
        '9 556km',
        'Essence',
        'orange'
    );

#insert into table pictures
insert into
    pictures(
        is_principal,
        image1,
        image2,
        image3,
        car_id
    )
values (
        'true',
        '00car.png',
        '001car.png',
        '002car.png',
        1
    );

insert into
    pictures(
        is_principal,
        image1,
        image2,
        image3,
        car_id
    )
values ('true', '01car.png', '', '', 2), ('true', '02car.png', '', '', 3), ('true', '03car.png', '', '', 4), ('true', '04car.png', '', '', 5), ('true', '05car.png', '', '', 6), ('true', '06car.png', '', '', 7), ('true', '07car.png', '', '', 8);

#insert into services 
insert into
    services(service, description, image)
values (
        'Climatisation',
        'Nous réalisons l entretier, la recharge et la réparation de la clim',
        'clim.jpg'
    ), (
        'Vidange',
        'Filtre à huile, du filtre à air, filtre habitacle et filtre à gasoil',
        'vidange.jpg'
    ), (
        'Carrossierie et tôlerie',
        'Remplacement, décabossage, redressage, passage au marbre, réparation de choc',
        'carosserie.jpg'
    ), (
        'Distribution',
        'Changement de la courroie de distribution',
        'distribution.jpg'
    ), (
        'Vitrage et phares',
        'Réparations de votre pare-brise, glaces latérales, lunette arrière ainsi que la restauration de vos phares',
        'vitrage.jpg'
    );

#insert into openingTimes 
insert into
    openingtimes(
        day,
        morningOpen,
        morningClose,
        afternoonOpen,
        afertnooClose
    )
values (
        'lundi',
        '8h45',
        '12h00',
        '14h00',
        '18h00'
    ), (
        'mardi',
        '8h45',
        '12h00',
        '14h00',
        '18h00'
    ), (
        'mercredi',
        '8h45',
        '12h00',
        '14h00',
        '18h00'
    ), (
        'jeudi',
        '8h45',
        '12h00',
        '14h00',
        '18h00'
    ), (
        'vendredi',
        '8h45',
        '12h00',
        '14h00',
        '18h00'
    ), (
        'samedi',
        '8h45',
        '12h00',
        'fermé',
        'fermé'
    ), (
        'dimanche',
        'fermé',
        'fermé',
        'fermé',
        'fermé'
    );

# insert into role
insert into role(name)
values ('administrator'), ('employe');

# ajouter les mot de passe par php
# insert into users 
insert into
    users (mail_id, name, firstname)
values (
        'vparrot@gmail.com',
        'Parrot',
        'Vincent'
    ), (
        'JPlantin@gmail.com',
        'PLantin',
        'Jeanne'
    ), (
        'JCracos@gmail.com',
        'Cracos',
        'Jean'
    ), (
        'MBenard@gmail.com',
        'Benard',
        'Marc'
    ), (
        'GBoutin@gmail.com',
        'Boutin',
        'Gerard'
    );

# insert into opinions
insert into
    opinions(nameClient, comment, note, date)
values (
        'Jeanne Boulin',
        'Service rapide et efficace, je recommande',
        5,
        '2020-09-24'
    ), (
        'Pierre Rondin',
        'Je suis tombé au mauvias moment, il y avait beaucoup d\'attente, mais ils ont su me faire pacienté avec un petit café',
        4,
        '2021-03-12'
    ), (
        'Sandrine Chalin',
        'J\'ai acheté une voiture d\'occasion, je suis très satisfaite',
        5,
        '2022-06-15'
    ), (
        'Jean Rrucj',
        'Très professionnel et d\'une grande humanité',
        4,
        '2022-12-18'
    );

delete from
    opinions # insert into users-role 
insert into
    users_role(role_id, mail_id)
values (1, 'vparrot@gmail.com'), (2, 'JPlantin@gmail.com'), (2, 'JCracos@gmail.com'), (2, 'MBenard@gmail.com'), (2, 'GBoutin@gmail.com');

# requete SQL 
# jointure entre cars et pictures
select * 
from cars c 
join pictures p on c.car_id  = p.picture_id;