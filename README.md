# Squid Config Files

## Squid Cache &amp; Proxy (Feb. 2021)

---

### Requirements

sudo apt-get install squid -y   
sudo apt-get install apache2 -y   
sudo apt-get install net-tools -y     

---

### Steps for moving squid.conf to /etc/squid/ on Ubuntu Server  

cd /etc/squid/  
sudo git clone https://github.com/peyton-brown/squidproxy-mysql-php-configuration.git
cd squidproxy-mysql-php-configuration/
sudo mv /etc/squid/qsi-squid-config-files/* /etc/squid/   
cd ../   

---

### Connect to Proxy with FireFox

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

### Add user to Proxy
cd /etc/squid   
sudo htpasswd pwd (username)   
-Enter Password   
-Default Username/PWD is root/root   

---
