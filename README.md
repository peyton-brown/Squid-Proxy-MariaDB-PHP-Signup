# Squid Proxy + Maria Database + PHP Signup Website
#### Recommended: VM with Ubuntu Server 20.04
---

## Requirements:

### Change Root Password
- sudo passwd root
- su -

### Update & Install Dependencies
- apt-get update && apt-get upgrade -y         
- apt-get install openssh-server autoconf automake apt-utils grep wget net-tools g++ git vim gawk perl dpkg-dev libncurses5-dev libldap2-dev libpam0g-dev libdb-dev cdbs libsasl2-dev debhelper libcppunit-dev libkrb5-dev comerr-dev libcap2-dev libecap3-dev libexpat1-dev libxml2-dev autotools-dev libltdl-dev pkg-config libnetfilter-conntrack-dev nettle-dev libgnutls28-dev bison build-essential cmake binutils software-properties-common devscripts equivs bison flex -y        

---

## Squid Install Steps:
- apt-get install squid -y         

### Git Clone Folder:
- mkdir /git; cd /git/       
- git clone https://github.com/peyton-brown/Squid-Proxy-MariaDB-PHP-Signup.git; cd /             
- cp /git/Squid-Proxy-MariaDB-PHP-Signup/squid.conf /etc/squid/; cp /git/Squid-Proxy-MariaDB-PHP-Signup/Whitelist-Blacklist/allowed-sites.txt /etc/squid/; cp /git/Squid-Proxy-MariaDB-PHP-Signup/Whitelist-Blacklist/blocked-sites.txt /etc/squid/  

### Whitelist/Blacklist:

#### In squid.conf (/etc/squid/squid.conf), comment or uncomment depending on your needs. If you use a whitelist, the blacklist is not necessary and vice versa, though you can still use both if needed.

![Picture showing what to comment and uncomment from squid.conf](https://i.imgur.com/6N0DPFA.png)

### Change the Whitelist/Blacklist to your needs.
- vim /etc/squid/allowed-sites.txt         
- vim /etc/squid/blocked-sites.txt

### Open the 3128 port in the firewall:
- ufw allow in "Squid"    

### Starting Squid:  
- systemctl stop squid        

### Create swap directories using -z, you will have to Ctrl+C once you see "Removing PID file".     
- squid -z          

### Start the Squid service & Enable the service to start automatically when the system boots:        
- systemctl start squid; systemctl enable squid        

### Check if Squid is running:       
- systemctl status squid       

![Picture verifying Squid is running](https://i.imgur.com/UkN5Dtd.png)

[Squid Wiki](https://wiki.squid-cache.org/SquidFaq/InstallingSquid) || [Red Hat Documentation](https://access.redhat.com/documentation/en-us/red_hat_enterprise_linux/7/html/networking_guide/configuring-the-squid-caching-proxy-server) || [Useful Blog Site](http://jitenjha.blogspot.com/2014/01/configure-squid-proxy-server.html)

---

## MariaDB Install Steps:     
- apt-get install mariadb-server mariadb-client -y; service mysql restart; mysql_secure_installation      

#### The first prompt will ask you to enter the current database root password. Since there is not one setup, ***press ENTER to indicate “none”***.

#### The next prompt asks you whether you’d like to set up a database root password. This is not important for Squid but if you have a use for this you can type Y, if not ***Type N and then press ENTER.***.

#### From there, you can ***press Y and then ENTER to accept the defaults for all the subsequent questions***. This will remove some anonymous users and the test database, disable remote root logins, and load these new rules so that MariaDB immediately implements the changes you have made.  

#### Run MariaDB as root.
- mariadb -u root -h localhost      

### Query Code is in the [MariaDB folder.](https://github.com/peyton-brown/Squid-Proxy-MariaDB-PHP-Signup/blob/main/MariaDB/make-db.sql)

---

## PHP/Apache2 Install Steps:
- apt-get install apache2 php php-cgi libapache2-mod-php php-common php-pear php-mbstring php-mysql -y; ufw allow 'Apache Full'; ufw enable; ufw status       

#### Copy Website to Apache folder:
- cp -r /git/Squid-Proxy-MariaDB-PHP-Signup/PHP-Signup-Website/* /var/www/html; rm -rf /var/www/html/index.html; systemctl restart apache2            

#### To verify Apache was installed correctly and the website has been copied over, open a web browser and type your ip into the address bar. Replace 192.168.1.254 with the IP address of your server. If you are unsure what your IP address is, run the following command:       
- hostname -I           

![Where to put IP in Google Chrome](https://i.imgur.com/zVzTrVH.png)

### NOTE: This method only works on a local network unless you port forward. If you want to setup multiple websites on the same server use [Virtual Hosts](https://linuxize.com/post/how-to-install-apache-on-ubuntu-20-04/#setting-up-a-virtual-host) and a domain.

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
