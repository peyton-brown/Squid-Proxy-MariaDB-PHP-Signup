# Squid Config Files

## Squid Proxy & MySQL DB (Feb. & Mar. 2021)

---

## Requirements:
- apt-get update         
- apt-get install dpkg-dev libldap2-dev libpam0g-dev libdb-dev cdbs libsasl2-dev debhelper libcppunit-dev libkrb5-dev comerr-dev libcap2-dev libecap3-dev libexpat1-dev libxml2-dev autotools-dev libltdl-dev pkg-config libnetfilter-conntrack-dev nettle-dev libgnutls28-dev build-essential binutils autoconf automake grep wget net-tools g++ git vim gawk perl mysql-server -y      

---

## Squid Install Steps:
- mkdir /build          
- cd /build      
- git clone https://github.com/squid-cache/squid.git  squid       
- cd squid     
- git branch -r       
- git checkout v4        
- ./bootstrap.sh         
- mkdir build; cd build            
- ../configure --prefix=/opt/squid/ --with-default-user=squid --enable-ssl --disable-inlined --with-logdir=/opt/squid/log/squid --with-pidfile=/opt/squid/run/squid.pid --enable-storeio=ufs,aufs --enable-removal-policies=lru,heap --enable-icmp --enable-useragent-log --enable-referer-log --enable-cache-digests --with-large-files --disable-auto-locale --disable-translation --enable-linux-netfilter --enable-delay-pools --disable-htcp --disable-wccp --disable-wccp2 --enable-arp-acl --disable-optimizations       
- make     
- make install         

### Location of Squid Files:  
- cd /opt/squid      

### Add Squid User & Give Permission to run/var/log folders:    
- adduser squid           

- chown -R squid:squid /opt/squid/run         
- chown -R squid:squid /opt/squid/var            
- chown -R squid:squid /opt/squid/log           

### Git Clone Folder:
- mkdir /git      
- cd /git/       
- git clone https://github.com/peyton-brown/squidproxy-mysql-php-configuration.git              
- cd squidproxy-mysql-php-configuration.git             

### Copy files to destination:
- cp /git/squidproxy-mysql-php-configuration/squid.conf /opt/squid/etc/   &&    cp /git/squidproxy-mysql-php-configuration/Whitelist/allowed_sites.acl /opt/squid/etc/    &&    cp /git/squidproxy-mysql-php-configuration/MySQLFiles/basic_db_auth /opt/squid/libexec/     

### Edit the http_port to your ip in squid.conf:        
- http_port ipv4:3128         

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

## MySQL-Server Install Steps:
- apt-get install mysql-server    
- mysql_secure_installation   

The first prompt will ask whether you’d like to set up the Validate Password Plugin, which can be used to test the strength of your MySQL password. Regardless of your choice, the next prompt will be to set a password for the MySQL root user. Enter and then confirm a secure password of your choice. From there, you can press Y and then ENTER to accept the defaults for all the subsequent questions. [SOURCE](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)    

- sudo mysql   

### MySQL code is in the MySQLFiles folder.

---

## Squid Configuration with MySQL Authentication:

- cd /opt/squid/libexec/    
- sudo vim basic_db_auth    

Search for 'my $dsn ='   
- Example: (my $dsn = "DBI:mysql:database=yourdatabasename;host=192.168.1.1";)    
Change 'yourdatabasename' to whatever your database name is    
Change 'host' to ip of mysql server (ifconfig)    

Leave '$db_user' & '$db_passwd' as undef    

Change '$db_table' to the table name where username/password is saved    
- Example: (my $db_table = "users";)    

Change '$db_usercol' to the username column in mysql table    
- Example: (my $db_usercol = "username";)    

Change '$db_passwdcol' to the password column in mysql table    
- Example: (my $db_passwd = "password";)    

[SOURCE](http://linchpincorner.blogspot.com/2016/08/squid-proxy-server-configuration-with_23.html)

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

1.

---
