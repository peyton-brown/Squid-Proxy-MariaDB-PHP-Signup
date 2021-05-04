CREATE DATABASE squid;

USE squid;

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(32) NOT NULL default '',
  password VARCHAR(32) NOT NULL default '',
  fullname VARCHAR(64) default NULL
);

INSERT INTO users(username, password, fullname) VALUES ('testUser', 'testPWD', 'Test User');

SHOW TABLES;

SELECT * FROM users;
