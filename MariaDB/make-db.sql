CREATE DATABASE squid;

CREATE USER 'squidUser'@'localhost' identified by 'squidPassword';
GRANT ALL PRIVILEGES ON squid.* to 'squidUser'@'localhost';

USE squid;

CREATE TABLE passwd (
    user varchar(32) NOT NULL default '',
    password varchar(35) NOT NULL default '',
    enabled tinyint(1) NOT NULL default '1',
    PRIMARY KEY (user)
);

INSERT INTO passwd VALUES('testUser','testPWD',1);

SHOW TABLES;

SELECT * FROM passwd;

quit
