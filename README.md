# Squid Proxy + Maria Database + PHP Front-End
#### Ubuntu Server 20.04.2
---

## Requirements:

### Change Root Password
- sudo passwd root
- su -

### Update & Install Dependencies
- apt-get update && apt-get upgrade -y         
- apt-get install openssh-server dpkg-dev libncurses5-dev libldap2-dev libpam0g-dev libdb-dev cdbs libsasl2-dev debhelper libcppunit-dev libkrb5-dev comerr-dev libcap2-dev libecap3-dev libexpat1-dev libxml2-dev autotools-dev libltdl-dev pkg-config libnetfilter-conntrack-dev nettle-dev libgnutls28-dev apt-utils bison build-essential cmake binutils autoconf automake grep wget net-tools g++ git vim gawk perl software-properties-common devscripts equivs bison flex -y        

---

## Squid Install Steps:
- apt-get install squid -y         

### Git Clone Folder:
- mkdir /git; cd /git/       
- git clone https://github.com/peyton-brown/Squid_Proxy-MariaDB-PHP-Configuration.git; cd Squid_Proxy-MariaDB-PHP-Configuration             
- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/squid.conf /etc/squid/          
- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/Whitelist/allowed_sites.txt /etc/squid/      
- cp /git/Squid_Proxy-MariaDB-PHP-Configuration/MariaDB/basic_db_auth /usr/lib/squid/       

### Change the Whitelist to your needs.
- vim /etc/squid/allowed_sites.txt         

### Edit the "my $dsn" to your ip in basic_db_auth (/usr/lib/squid/basic_db_auth):    
- my $dsn = "DBI:mysql:database=squid;host=ipv4";

### Edit the "http_port to your ip in squid.conf (/etc/squid/squid.conf):        
- http_port ipv4:3128       

### Open the 3128 port in the firewall:
- ufw allow in "Squid"        

### Starting Squid:  
- systemctl stop squid        

Create swap directories using -z.     
- squid -z          

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

[Squid Wiki](https://wiki.squid-cache.org/SquidFaq/InstallingSquid) || [Red Hat Documentation](https://access.redhat.com/documentation/en-us/red_hat_enterprise_linux/7/html/networking_guide/configuring-the-squid-caching-proxy-server) || [Useful Blog Site](http://jitenjha.blogspot.com/2014/01/configure-squid-proxy-server.html)

---

## MariaDB Install Steps:        
- apt-get install mariadb-server mariadb-client -y; service mysql restart        

First run MariaDB as root.
- mariadb -u root -p -h localhost      

Run the first set of query code [(located in make-user.sql file)](https://github.com/peyton-brown/Squid_Proxy-MariaDB-PHP-Configuration/blob/main/MariaDB/make-user.sql).

After running the first set of query code, move onto the squidUser user.
- mariadb -u squidUser -p -h localhost

Run the second set of query code [(located in make-db.sql file)](https://github.com/peyton-brown/Squid_Proxy-MariaDB-PHP-Configuration/blob/main/MariaDB/make-db.sql).

---

## PHP/Apache2 Install Steps:
- apt-get install apache2 php php-cgi libapache2-mod-php php-common php-pear php-mbstring php-mysql -y; ufw allow 'Apache Full'; ufw enable; ufw status       

### Verify Apache Installation
To verify Apache was installed correctly, open a web browser and type in the address bar:       
- http://192.168.0.0            

Replace 192.168.0.0 with the IP address of your server. If you are unsure what your IP address is, run the following command:       
- hostname -I | awk '{print $1}'     

#### Copy Website to Apache folder:
- cp -r /git/Squid_Proxy-MariaDB-PHP-Configuration/PHP-Signup-Website/* /var/www/html; rm -rf /var/www/html/index.html            

### Restart Apache
- systemctl restart apache2

### NOTE: This method only works on a local network unless you port forward. If you want to setup multiple websites on the same server use the Linuxize source or [click here](https://linuxize.com/post/how-to-install-apache-on-ubuntu-20-04/#setting-up-a-virtual-host).

[Phoenixnap Apache Installation Steps](https://phoenixnap.com/kb/how-to-install-apache-web-server-on-ubuntu-18-04) || [Linuxize](https://linuxize.com/post/how-to-install-apache-on-ubuntu-20-04/)

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
