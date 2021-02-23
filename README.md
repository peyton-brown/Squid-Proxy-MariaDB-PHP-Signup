# Squid Config Files

## Squid Proxy &amp; MySQL DB (Feb. 2021)

---

## Requirements

sudo apt-get install net-tools   
sudo apt-get install wget    
sudo apt-get install build-essential    
sudo apt-get install mysql-server     
sudo apt-get install apache2     

---

## Squid Install Steps (for DB)

cd /tmp/    
wget http://www.squid-cache.org/Versions/v4/squid-4.14.tar.gz    
sudo tar -zxvf squid-4.14.tar.gz    
cd squid-4.14/     
./configure --enable-basic-auth-helpers=DB    
make     
sudo make install        

### Location of Squid Files:
cd /usr/local/squid    

---

## MySQL-Server Install Steps

sudo apt-get install mysql-server    
sudo mysql_secure_installation   

The first prompt will ask whether you’d like to set up the Validate Password Plugin, which can be used to test the strength of your MySQL password. Regardless of your choice, the next prompt will be to set a password for the MySQL root user. Enter and then confirm a secure password of your choice. From there, you can press Y and then ENTER to accept the defaults for all the subsequent questions. [SOURCE](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)    

sudo mysql   

### MySQL code is in the MySQLFiles folder.

---

## Squid Configuration with MySQL Authentication

cd /usr/local/squid/libexec/    
sudo vim basic_db_auth    

Search for 'my $dsn ='   
  Example: (my $dsn = "DBI:mysql:database=yourdatabasename;host=192.168.1.1";)    
Change 'yourdatabasename' to whatever your database name is    
Change 'host' to ip of mysql server (ifconfig)    

Leave '$db_user' & '$db_passwd' as undef    

Change '$db_table' to the table name where username/password is saved    
  Example: (my $db_table = "users";)    

Change '$db_usercol' to the username column in mysql table    
  Example: (my $db_usercol = "username";)    

Change '$db_passwdcol' to the password column in mysql table    
  Example: (my $db_passwd = "password";)    

[SOURCE](http://linchpincorner.blogspot.com/2016/08/squid-proxy-server-configuration-with_23.html)

---

## Move files from Git Clone to folders on server

cd    
sudo mkdir git      
cd git       
git clone https://github.com/peyton-brown/squidproxy-mysql-php-configuration.git              
cd squidproxy-mysql-php-configuration.git             

### Move squid.conf & Whitelist

sudo mv squid.conf /usr/local/squid/etc/            
sudo mv Whitelist/allowed_sites.acl /usr/local/squid/etc/         

### Move basic_db_auth

sudo mv basic_db_auth /usr/local/squid/libexec/          

---

## Connect to Proxy with FireFox

On Firefox, go to options   
Network Settings   
Manual proxy configuration   
Go to your Ubuntu Server and type in 'ifconfig'   
Find the inet address (ip address)   
Go back to Firefox   
Enter that ip into HTTP Proxy   
Check 'Also use this proxy for FTP and HTTPS'   
Make sure the port is the same as the one in squid.conf   
Click OK   

---
