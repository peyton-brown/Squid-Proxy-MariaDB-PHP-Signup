CREATE USER 'dataproxy'@'localhost' IDENTIFIED BY 'dataproxy';

CREATE DATABASE squid;

GRANT ALL PRIVILEGES ON squid.* TO 'dataproxy'@'localhost';

quit;
