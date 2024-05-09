-- create table user(
--     id int primary key auto_increment,
--     username varchar2(50) not null,
--     name varchar2(50) not null,
--     age int not null,
--     prename varchar2(50) not null,
--     password varchar2(50) not null,
--     email varchar2(50) not null,
--     phone varchar2(50) not null,
--     pays varchar2(50) not null,
--     image varchar2(511) not null
-- );

-- create table admin(
--     id int primary key auto_increment,
--     username varchar2(50) not null,
--     password varchar2(50) not null
-- );

-- -- ALTER TABLE 'user' MODIFY COLUMN username varchar2(50) NOT NULL UNIQUE;

-- create table mailcode(
--     code varchar(50) not null,
--     id int not null,
--     PRIMARY KEY (code, id),
--     FOREIGN KEY (id) REFERENCES user(id)
-- );

-- create table room_images(
--     id int auto_increment,
--     room_id int not null,
--     PRIMARY KEY (id, room_id),
--     FOREIGN KEY (room_id) REFERENCES room(id)
-- );


-- create table hotel(
--     id int primary key auto_increment,
--     name varchar(50) not null,
--     adresse varchar(50) not null,
--     phone varchar(50) not null,
--     email varchar(50) not null,
--     id_countries int(11) not null,
--     id_state int(11) not null,
--     nbrcomment int,
--     nbrstar int,
--     FOREIGN KEY (id_countries) REFERENCES countries(countries_id),
--     FOREIGN KEY (id_state) REFERENCES states(id_state)
--     );

    

-- INSERT INTO hotel (name, adresse, phone, email, name, id_state, nbrcomment, nbrstar)
-- VALUES ('Hotel sidi yahya', '3 rue Saidi Ahmed, Bordj El-Kiffen, Algiers, 16000', '123 456 789', 'a33@mail.com', 113,3 )




-- CREATE TABLE IF NOT EXISTS `states` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(30) NOT NULL,
--   `name_countries` varchar(150) NOT NULL,
--   PRIMARY KEY (`id`),
--     FOREIGN KEY (`name_countries`) REFERENCES `countries`(`name`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
  


-- CREATE TABLE IF NOT EXISTS `countries` (
--   `shortname` varchar(3) NOT NULL,
--   `name` varchar(150) NOT NULL,
--   `phonecode` int(11) NOT NULL,
--   PRIMARY KEY (`name`)
-- ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=249 ;



-- CREATE TABLE comment (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     hotel_id INT NOT NULL,
--     user_id INT NOT NULL,
--     comment_text VARCHAR(255) NOT NULL,
--     date_comment DATE NOT NULL,
--     FOREIGN KEY (user_id) REFERENCES user(id),
--     note INT NOT NULL,
--     FOREIGN KEY (hotel_id) REFERENCES hotel(id)
-- );

-- Create table hotel_images(
--     id int auto_increment,
--     hotel_id int not null,
--     url varchar(50) not null,
--     FOREIGN KEY (hotel_id) REFERENCES hotel(id),
--     PRIMARY KEY (id, hotel_id)
-- );

-- ALTER TABLE room_images ADD COLUMN url varchar(511) not null;

-- create table 'note_hotel'(
--     id int primary key auto_increment,
--     hotel_id int not null,
--     note int not null,
--     FOREIGN KEY (id, hotel_id) REFERENCES hotel(id)
-- );

-- CREATE table 'note_room'(
--     id int primary key auto_increment,
--     room_id int not null,
--     note int not null,
--     FOREIGN KEY (room_id) REFERENCES room(id)
-- );

-- CREATE TRIGGER increment_nbrcomment
-- AFTER INSERT ON comment
-- FOR EACH ROW
-- BEGIN
--     UPDATE hotel
--     SET nbrcomment = nbrcomment + 1
--     WHERE id = NEW.hotel_id;
-- END;

-- create table type(
--     id int primary key auto_increment,
--     name varchar(50) not null,
--     description varchar(50) not null
-- );

-- create table room(
--     id int primary key auto_increment,
--     hotel_id int not null,
--     id_type int not null,
--     price int not null,
--     capacity int not null,
--     FOREIGN KEY (id_type) REFERENCES type(id),
--     FOREIGN KEY (hotel_id) REFERENCES hotel(id)
-- );

-- -- create a table that i can store on it if the room has spq or wifi or pisine
-- create table option(
--     id int primary key auto_increment,
--     name varchar(50) not null,
--     description varchar(511) not null
-- );

-- create table room_option(
--     room_id int not null,
--     option_id int auto_increment not null,
--     PRIMARY KEY (room_id, option_id),
--     FOREIGN KEY (room_id) REFERENCES room(id),
--     FOREIGN KEY (option_id) REFERENCES option(id)
-- );

-- CREATE table hotel_option(
--     hotel_id int not null,
--     option_id int auto_increment not null,
--     PRIMARY KEY (hotel_id, option_id),
--     FOREIGN KEY (hotel_id) REFERENCES hotel(id),
--     FOREIGN KEY (option_id) REFERENCES option(id)
-- );





-- create table reservation(
--     id int primary key auto_increment,
--     user_id int not null,
--     room_id int not null,
--     date_debut date not null,
--     date_fin date not null,
--     nbr_person int not null,
--     status varchar(50) not null,
--     FOREIGN KEY (user_id) REFERENCES user(id),
--     FOREIGN KEY (room_id) REFERENCES room(id)
-- );

-- create table room_reservation(
--     id int primary key auto_increment,
--     room_id int not null,
--     reservation_id int not null,
--     FOREIGN KEY (room_id) REFERENCES room(id),
--     FOREIGN KEY (reservation_id) REFERENCES reservation(id)
-- );

-- create table room_occupe(
--     id int primary key auto_increment,
--     room_id int not null,
--     date_debut date not null,
--     date_fin date not null,
--     FOREIGN KEY (room_id) REFERENCES room(id)
-- );

-- create table devise(
--     id int primary key auto_increment,
--     name varchar(50) not null
-- );

-- create table taux_change(
--     id int primary key auto_increment,
--     devise_id int not null,
--     taux float not null,
--     date date not null,
--     FOREIGN KEY (devise_id) REFERENCES devise(id)
-- );


CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE hotel (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    countries_id INT,
    id_state INT,
    nbrcomment INT DEFAULT 0,
    nbstar INT,
    FOREIGN KEY (countries_id) REFERENCES countries(countries_id),
    FOREIGN KEY (id_state) REFERENCES states(id_state)
);

CREATE TABLE room (
    id INT AUTO_INCREMENT,
    hotel_id INT,
    id_type INT,
    price DECIMAL(10, 2) NOT NULL,
    capacity INT NOT NULL,
    PRIMARY KEY (id, hotel_id),
    FOREIGN KEY (hotel_id) REFERENCES hotel(id),
    FOREIGN KEY (id_type) REFERENCES room_type(id)
);

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    prename VARCHAR(50) NOT NULL,
    age INT,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    pays VARCHAR(50),
    image VARCHAR(255)
);

CREATE TABLE reservation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    room_id INT,
    hotel_id INT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    nbr_person INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (room_id) REFERENCES room(id),
    FOREIGN KEY (hotel_id) REFERENCES hotel(id)
);

CREATE TABLE countries (
    countries_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    phonecode VARCHAR(10)
);

CREATE TABLE states (
    id_state INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    countries_id INT,
    FOREIGN KEY (countries_id) REFERENCES countries(countries_id)
);

CREATE TABLE devise (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE room_type (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

CREATE TABLE hotel_images (
    id INT AUTO_INCREMENT,
    hotel_id INT,
    url VARCHAR(255) NOT NULL,
    PRIMARY KEY (id, hotel_id),
    FOREIGN KEY (hotel_id) REFERENCES hotel(id)
);

CREATE TABLE room_images (
    id INT AUTO_INCREMENT,
    room_id INT,
    url VARCHAR(255) NOT NULL,
    PRIMARY KEY (id, room_id),
    FOREIGN KEY (room_id) REFERENCES room(id)
);

CREATE TABLE comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    comment_text TEXT NOT NULL,
    date_comment DATE NOT NULL,
    note INT,
    user_id INT,
    hotel_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (hotel_id) REFERENCES hotel(id)
);

CREATE TABLE option (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

CREATE TABLE room_option (
    room_id INT,
    option_id INT,
    FOREIGN KEY (room_id) REFERENCES room(id),
    FOREIGN KEY (option_id) REFERENCES option(id),
    PRIMARY KEY (room_id, option_id)
);



