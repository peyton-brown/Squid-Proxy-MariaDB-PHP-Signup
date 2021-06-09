CREATE USER 'squidUser'@'localhost' IDENTIFIED BY 'squidPassword';

CREATE DATABASE squid;

GRANT ALL PRIVILEGES ON squid.* TO 'squidUser'@'localhost';
