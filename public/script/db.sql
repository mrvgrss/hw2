create database hw2;
use hw2;
select * from USERS;
drop database hw2;

CREATE TABLE USERS (
   id INTEGER PRIMARY KEY AUTO_INCREMENT,
   email VARCHAR(255) NOT NULL UNIQUE,
   password VARCHAR(255) NOT NULL,
   name VARCHAR(64) NOT NULL,
   surname VARCHAR(64) NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE REVIEWS (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    userId INTEGER NOT NULL,
    title VARCHAR(25) NOT NULL UNIQUE,
    stars INT NOT NULL CHECK (stars BETWEEN 1 AND 5),
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES USERS(id)
);

CREATE TABLE AIRPORTS (
    iata VARCHAR(3) PRIMARY KEY,
    city VARCHAR(255),
    term VARCHAR(255),
    country VARCHAR(25),
    INDEX city_idx(city),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE FLIGHT_OFFERS (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    price FLOAT NOT NULL,
    base_price FLOAT NOT NULL,
    adults FLOAT NOT NULL,
    oneway BOOL NOT NULL,
    source_offert VARCHAR(3),
    last_ticketing_datetime DATETIME NOT NULL,
    bookedUserId INTEGER NULL,
    destination VARCHAR(3) NOT NULL,
    origin VARCHAR(3) NOT NULL,
    departureDate DATE NOT NULL,
    returnDate DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (bookedUserId) REFERENCES USERS(id)
);

CREATE TABLE FLIGHTS (
    offertId INTEGER NOT NULL,
    outbound BOOL NOT NULL,
    duration VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (offertId) REFERENCES FLIGHT_OFFERS(id),
    PRIMARY KEY (offertId, outbound)
);

CREATE TABLE SEGMENTS (
    offertId INTEGER NOT NULL,
    outbound BOOL NOT NULL,
    segment_n INTEGER NOT NULL,
    duration VARCHAR(15) NOT NULL,
    departure_airport VARCHAR(3) NOT NULL,
    departure_terminal VARCHAR(3) NOT NULL,
    departure_datetime DATETIME NOT NULL,
    arrival_airport VARCHAR(3) NOT NULL,
    arrival_datetime DATETIME NOT NULL,
    company_name VARCHAR(150) NOT NULL,
    aircraft VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (offertId, outbound) REFERENCES FLIGHTS(offertId, outbound),
    PRIMARY KEY (offertId, outbound, segment_n)
);

CREATE TABLE FAVOURITE (
    userId INTEGER NOT NULL,
    city VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES USERS(id),
    PRIMARY KEY (userId, city)
);