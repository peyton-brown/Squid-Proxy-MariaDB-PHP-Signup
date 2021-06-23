CREATE DATABASE squid;

CREATE USER 'squidUser'@'localhost' identified by 'squidPassword';
GRANT ALL PRIVILEGES ON squid.passwd to 'squidUser'@'localhost';

USE squid;

CREATE TABLE passwd (
    user varchar(32) NOT NULL default '',
    password varchar(35) NOT NULL default '',
    PRIMARY KEY (user)
);

INSERT INTO passwd VALUES('testUser','testPWD');

SHOW TABLES;

SELECT * FROM passwd;

quit
