CREATE DATABASE squid;

USE squid;

CREATE TABLE passwd (
    user varchar(32) NOT NULL default '',
    password varchar(35) NOT NULL default'',
    PRIMARY KEY (user)
);

INSERT INTO passwd VALUES('testUser','testPWD');
