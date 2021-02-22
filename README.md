# Squid Config Files

## Squid Proxy &amp; MySQL DB (Feb. 2021)

---

## Requirements

sudo apt-get install net-tools   
sudo apt-get install apache2    
sudo apt-get install wget    
sudo apt-get install build-essential    

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

The first prompt will ask whether you’d like to set up the Validate Password Plugin, which can be used to test the strength of your MySQL password. Regardless of your choice, the next prompt will be to set a password for the MySQL root user. Enter and then confirm a secure password of your choice. From there, you can press Y and then ENTER to accept the defaults for all the subsequent questions.    

###MySQL code is in the MySQLFiles folder.

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

## Add user to Proxy (temporary until sql works)
cd /etc/squid   
sudo htpasswd pwd (username)   
-Enter Password   
-Default Username/PWD is root/root   

---
