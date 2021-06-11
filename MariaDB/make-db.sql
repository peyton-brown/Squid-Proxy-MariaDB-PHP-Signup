CREATE DATABASE squid;

GRANT SELECT ON squid.* to dataproxy@localhost identified by 'dataproxy';

USE squid;

CREATE TABLE passwd (
    user varchar(32) NOT NULL default '',
    password varchar(35) NOT NULL default'',
    PRIMARY KEY (user)
);

INSERT INTO passwd VALUES('testUser','testPWD');

quit;
