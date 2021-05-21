# Squid Config Files

## Squid Proxy & MySQL DB (Feb. & Mar. 2021)

---

## Requirements:
- apt-get update && apt-get upgrade -y         
- apt-get install dpkg-dev libncurses5-dev libldap2-dev libpam0g-dev libdb-dev cdbs libsasl2-dev debhelper libcppunit-dev libkrb5-dev comerr-dev libcap2-dev libecap3-dev libexpat1-dev libxml2-dev autotools-dev libltdl-dev pkg-config libnetfilter-conntrack-dev nettle-dev libgnutls28-dev apt-utils bison build-essential cmake binutils autoconf automake grep wget net-tools g++ git vim gawk perl software-properties-common devscripts equivs bison flex -y        

---

## Squid Install Steps:
- mkdir /build; cd /build   
- git clone https://github.com/squid-cache/squid.git squid; cd squid        
- git checkout v4; ./bootstrap.sh         
- mkdir build; cd build            
- ../configure --enable-basic-auth-helpers=DB --prefix=/opt/squid/ --with-default-user=squid --enable-ssl --disable-inlined --with-logdir=/opt/squid/log/squid --enable-storeio=ufs,aufs --enable-removal-policies=lru,heap --enable-icmp --enable-useragent-log --enable-referer-log --enable-cache-digests --with-large-files --disable-auto-locale --disable-translation --enable-linux-netfilter --enable-delay-pools --disable-htcp --disable-wccp --disable-wccp2 --enable-arp-acl --disable-optimizations       
- make     
- make install         

### Location of Squid Files:  
- cd /opt/squid      

### Add Squid User & Give Permission to run/var/log folders:    
- adduser squid           

- chown -R squid:squid /opt/squid/var            
- chown -R squid:squid /opt/squid/log           

### Git Clone Folder:
- mkdir /git; cd /git/       
- git clone https://github.com/peyton-brown/Squid_Proxy-MariaDB-PHP-Configuration.git              
- cd Squid_Proxy-MariaDB-PHP-Configuration             

### Copy files to destination:
- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/squid.conf /opt/squid/etc/

- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/Whitelist/allowed_sites.acl /opt/squid/etc/

- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/MariaDB/basic_db_auth /opt/squid/libexec/     

### Edit the http_port to your ip in squid.conf:        
- http_port ipv4:3128  

### Edit ip in basic_db_auth:
* vim /opt/squid/libexec/basic_db_auth     

* Search for 'my $dsn ='      
    * Change 'host' to ip of mysql server (ifconfig)

[SOURCE](http://linchpincorner.blogspot.com/2016/08/squid-proxy-server-configuration-with_23.html)       

### Switch to squid user:
- su squid      

### Add squid to $PATH:
- export PATH=$PATH:/opt/squid/sbin/      

### Starting Squid:    
After compiling squid, run this command to verify your configuration file. If this outputs any errors then these are syntax errors or other fatal misconfigurations and needs to be corrected before you continue. If it is silent and immediately gives back the command prompt then your squid.conf is syntactically correct and could be understood by Squid.       
- squid -k parse        

Create swap directories using -z.     
- squid -z     

If you want to run squid in the background or on startup, leave off all options:          
- squid           

Check if squid is running:      
- ps -e | grep squid           

[SOURCE](https://wiki.squid-cache.org/SquidFaq/InstallingSquid)             

---

## SquidGuard Install Steps:

- cd /build/
- ./configure
- make
- make install

http://www.squidguard.org/Downloads/squidGuard-1.3.tar.gz

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

## Squid Install Steps: (Docker)

### Build Docker Image:
- docker build -t ubuntu-squid-mariadb:1.2 .       

### Edit the http_port to your ip in squid.conf:        
- http_port ipv4:3128      

### Switch to squid user:
- su squid      

### Add squid to $PATH:
- export PATH=$PATH:/opt/squid/sbin/      

### Starting Squid through Docker:
Create swap directories using -z.     
- squid -z     

If you want to run squid in the background or on startup, leave off all options:          
- squid           

Check if squid is running:      
- ps -e | grep squid       

---
