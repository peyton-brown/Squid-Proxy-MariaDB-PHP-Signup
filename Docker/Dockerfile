FROM ubuntu:20.04

LABEL maintainer="peytonedwardbrown@gmail.com"

#
## Squid
#

RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
        dpkg-dev \
        libldap2-dev \
        libdb-dev \
        cdbs \
        libsasl2-dev \
        debhelper \
        libcppunit-dev \
        libkrb5-dev \
        comerr-dev \
        libcap2-dev \
        libecap3-dev \
        libexpat1-dev \
        libxml2-dev \
        libncurses5-dev \
        autotools-dev \
        libltdl-dev \
        pkg-config \
        libnetfilter-conntrack-dev \
        nettle-dev \
        libgnutls28-dev \
        build-essential \
        binutils \
        bison \
        apt-utils \
        autoconf \
        automake \
        grep \
        wget \
        net-tools \
        curl \
        g++ \
        git \
        vim \
        gawk \
        perl \
        software-properties-common \
        devscripts \
        equivs \
        cmake

RUN mkdir /build; cd /build && \
    git clone https://github.com/squid-cache/squid.git squid; cd squid && \
    git branch -r && \
    git checkout v4 && \
    ./bootstrap.sh && \
    mkdir build; cd build && \
    ../configure --prefix=/opt/squid/ --with-default-user=squid --enable-ssl --disable-inlined --with-logdir=/opt/squid/log/squid --with-pidfile=/opt/squid/run/squid.pid --enable-storeio=ufs,aufs --enable-removal-policies=lru,heap --enable-icmp --enable-useragent-log --enable-referer-log --enable-cache-digests --with-large-files --disable-auto-locale --disable-translation --enable-linux-netfilter --enable-delay-pools --disable-htcp --disable-wccp --disable-wccp2 --enable-arp-acl --disable-optimizations && \
    make && \
    make install

RUN DEBIAN_FRONTEND=noninteractive adduser squid && \
    chown -R squid:squid /opt/squid/run && \
    chown -R squid:squid /opt/squid/var && \
    chown -R squid:squid /opt/squid/log

RUN mkdir /git; cd /git && \
    git clone https://github.com/peyton-brown/Squid_Proxy-MariaDB-PHP-Configuration.git

RUN cp /git/Squid_Proxy-MariaDB-PHP-Configuration/squid.conf /opt/squid/etc/ && \
    cp /git/Squid_Proxy-MariaDB-PHP-Configuration/Whitelist/allowed_sites.acl /opt/squid/etc/ && \ 
    cp /git/Squid_Proxy-MariaDB-PHP-Configuration/MariaDB/basic_db_auth /opt/squid/libexec/

EXPOSE 3128/tcp


#
## MariaDB
#

RUN apt-get install mariadb-server -y && \
    service mysql restart

EXPOSE 3066/tcp
