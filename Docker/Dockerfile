FROM ubuntu:20.04

LABEL maintainer="peytonedwardbrown@gmail.com"

RUN dependendencies=" \
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
        autotools-dev \
        libltdl-dev \
        pkg-config \
        libnetfilter-conntrack-dev \
        nettle-dev \
        libgnutls28-dev \
        build-essential \
        binutils \
        autoconf \
        automake \
        grep \
        wget \
        net-tools \
        g++ \
        git \
        vim \
        gawk \
        perl \
    " \

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y $dependendencies*

RUN mkdir /build \
  && cd /build \
  && git clone https://github.com/squid-cache/squid.git squid \
  && cd squid \
  && git branch -r \
  && git checkout v4 \
  && ./bootstrap.sh \
  && mkdir build; cd build \
  && ../configure --prefix=/opt/squid/ --with-default-user=squid --enable-ssl --disable-inlined --with-logdir=/opt/squid/log/squid --with-pidfile=/opt/squid/run/squid.pid --enable-storeio=ufs,aufs --enable-removal-policies=lru,heap --enable-icmp --enable-useragent-log --enable-referer-log --enable-cache-digests --with-large-files --disable-auto-locale --disable-translation --enable-linux-netfilter --enable-delay-pools --disable-htcp --disable-wccp --disable-wccp2 --enable-arp-acl --disable-optimizations \
  && make \
  && make install*

ENV MYSQL_USER=mysql \
    MYSQL_VERSION=8.0.23 \
    MYSQL_DATA_DIR=/mysql/lib/mysql \
    MYSQL_RUN_DIR=/mysql/run/mysqld \
    MYSQL_LOG_DIR=/mysql/var/log/mysql

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y mysql-server=${MYSQL_VERSION}* \
    && rm -rf ${MYSQL_DATA_DIR} \
    && rm -rf /var/lib/apt/lists/*

RUN chmod 755 /sbin/entrypoint.sh

EXPOSE 3306/tcp
