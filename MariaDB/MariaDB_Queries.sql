CREATE USER 'squiduser'@'localhost' IDENTIFIED BY 'squidpwd';

CREATE DATABASE squid;

USE squid;

CREATE TABLE 'users' (
  'id' INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'username' VARCHAR(32) NOT NULL default '',
  'password' VARCHAR(32) NOT NULL default '',
  'fullname' VARCHAR(64) default NULL
);

CREATE TABLE 'users' ('id' INT NOT NULL AUTO_INCREMENT, 'username' VARCHAR(32) NOT NULL PRIMARY KEY default '', 'password' VARCHAR(32) NOT NULL default '', 'fullname' VARCHAR(64) default NULL);

INSERT INTO users VALUES('rootUser', 'rootPWD', 'Root User');

SHOW TABLES;

SELECT * FROM users;

GRANT ALL PRIVILEGES ON squid.* TO 'squiduser'@'localhost';
