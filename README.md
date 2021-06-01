# Squid Config Files

## Squid Proxy & MySQL DB (Feb. & Mar. 2021)

---

## Requirements:
- apt-get update && apt-get upgrade -y         
- apt-get install apache2 dpkg-dev libncurses5-dev libldap2-dev libpam0g-dev libdb-dev cdbs libsasl2-dev debhelper libcppunit-dev libkrb5-dev comerr-dev libcap2-dev libecap3-dev libexpat1-dev libxml2-dev autotools-dev libltdl-dev pkg-config libnetfilter-conntrack-dev nettle-dev libgnutls28-dev apt-utils bison build-essential cmake binutils autoconf automake grep wget net-tools g++ git vim gawk perl software-properties-common devscripts equivs bison flex firewalld -y        

---

## Squid Install Steps:
- apt-get install squid -y         

### Git Clone Folder:
- mkdir /git; cd /git/       
- git clone https://github.com/peyton-brown/Squid_Proxy-MariaDB-PHP-Configuration.git; Squid_Proxy-MariaDB-PHP-Configuration             
- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/squid.conf /etc/squid/        
- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/Whitelist/allowed_sites.txt /etc/squid/



### Edit the http_port to your ip in squid.conf (/etc/squid/):        
- http_port ipv4:3128       

### Open the 3128 port in the firewall:
- firewall-cmd --permanent --add-port=3128/tcp; firewall-cmd --reload         

### Starting Squid:  
- systemctl stop squid        

Create swap directories using -z.     
- squid -z          

Reconfigure squid.conf:        
- squid -k reconfigure

Start the squid service:
- systemctl start squid    

Enable the squid service to start automatically when the system boots:
- systemctl enable squid

Check if squid is running:       
- ps -e | grep squid      
- systemctl status squid     

### Verification Steps
To verify that the proxy works correctly, download a web page using the curl utility:       
-  curl -O -L "https://www.redhat.com/index.html" -x "ipv4:3128"

If curl does not display any error and the index.html file was downloaded to the current directory, the proxy works.       

[Squid Wiki](https://wiki.squid-cache.org/SquidFaq/InstallingSquid)


[Red Hat Documentation](https://access.redhat.com/documentation/en-us/red_hat_enterprise_linux/7/html/networking_guide/configuring-the-squid-caching-proxy-server)

---

## SquidGuard Install Steps:
- apt-get install squidGuard

---

## MariaDB Install Steps:        
- apt-get install mariadb-server -y       
- service mysql restart; mysql_secure_installation       

This will take you through a series of prompts where you can make some changes to your MariaDB installation’s security options. The first prompt will ask you to enter the current database root password. Since you have not set one up yet, press ENTER to indicate “none”.       

The next prompt asks you whether you’d like to set up a database root password. On Ubuntu, the root account for MariaDB is tied closely to automated system maintenance, so we should not change the configured authentication methods for that account. Doing so would make it possible for a package update to break the database system by removing access to the administrative account. Type N and then press ENTER.       

From there, you can press Y and then ENTER to accept the defaults for all the subsequent questions. This will remove some anonymous users and the test database, disable remote root logins, and load these new rules so that MariaDB immediately implements the changes you have made.      

- mariadb

### Query Code is in the [MariaDB folder.](https://github.com/peyton-brown/Squid_Proxy-MariaDB-PHP-Configuration/blob/main/MariaDB/MariaDB_Queries.sql)

---

## Connect to Proxy with FireFox:

- On Firefox, go to options   
- Network Settings   
- Manual proxy configuration   
- Go to your Ubuntu Server and type in 'ifconfig'   
- Find the inet address (ip address)   
- Go back to Firefox   
- Enter that ip into HTTP Proxy   
- Check 'Also use this proxy for FTP and HTTPS'   
- Make sure the port is the same as the one in squid.conf   
- Click OK   

---

## Potential Error Messages:

1. MariaDB: ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)
    - SOLUTION: service mysql restart

---
