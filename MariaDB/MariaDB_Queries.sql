CREATE DATABASE squid;

GRANT SELECT ON squid.* to dataproxy@localhost identified by 'dataproxy';

USE squid;

CREATE TABLE passwd (
    user varchar(32) NOT NULL default '',
    password varchar(35) NOT NULL default'',
    enabled tinyint(1) NOT NULL default '1',
    fullname varchar(60) default NULL,
    comment varchar(60) default NULL,
    PRIMARY KEY (user)
);

INSERT INTO passwd VALUES('testUser','testPWD',1,'Test User','comment test');

SHOW TABLES;

SELECT * FROM passwd;
