FROM debian:8

# Bash color
ENV TERM xterm
# Let the container know that there is no tty
ENV DEBIAN_FRONTEND noninteractive

# Env args
ARG TZ
ENV TZ $TZ

# Proxy
ARG PROXY
ARG NO_PROXY
ENV http_proxy $PROXY
ENV https_proxy $PROXY
ENV ftp_proxy $PROXY
ENV no_proxy $NO_PROXY

# Update system
RUN apt-get update

# Essential install
RUN apt-get install -qqy apt-transport-https ca-certificates software-properties-common python-software-properties iptables net-tools telnet curl wget htop supervisor unzip xz-utils nano vim

# Locale
RUN apt-get install -qqy locales
RUN echo 'en_US.UTF-8 UTF-8' >> /etc/locale.gen \
    && locale-gen \
    && dpkg-reconfigure locales
ENV LANGUAGE en_US:en
ENV LANG en_US.UTF-8
ENV LC_ALL en_US.UTF-8
ENV LC_CTYPE en_US.UTF-8
RUN echo $TZ > /etc/timezone \
    && dpkg-reconfigure -f noninteractive tzdata
RUN locale \
    && date

# PHP install
RUN echo 'deb http://packages.dotdeb.org jessie all' > /etc/apt/sources.list.d/dotdeb.list
RUN wget -O- https://www.dotdeb.org/dotdeb.gpg | apt-key add -
RUN apt-get update
RUN apt-get install -qqy php7.0 \
    && php -v \
    && apt-cache search php7-*
RUN apt-get install -qqy php7.0-cli php7.0-curl php7.0-dev php7.0-phpdbg php7.0-xdebug php7.0-xml
RUN phpdismod xdebug
RUN sed -i 's#;date.timezone =#date.timezone = '"$TZ"'#g' /etc/php/7.0/cli/php.ini

# User
ARG GID
ARG UID
RUN groupadd -g $GID php \
    && useradd -s /bin/bash -g $GID -u $UID php \
    && mkdir -p /home/php \
    && chown -R php:php /home/php

# Composer install
RUN wget -nv http://getcomposer.org/download/1.2.1/composer.phar -O /home/php/composer.phar \
    && chmod +x /home/php/composer.phar \
    && ln -fs /home/php/composer.phar /usr/local/bin/composer \
    && mkdir -p /home/php/.composer/ \
    && echo '{}' > /home/php/.composer/composer.json \
    && chown -R php:php /home/php/

# Clean
RUN apt-get clean \
    && rm -rf /tmp/* /var/tmp/*

# User

# .bashrc conf
COPY docker/php/.bashrc /etc/.bashrc
RUN cat /etc/.bashrc >> /etc/bash.bashrc

# Copy app
RUN mkdir -p /app \
    && chown -R php:php /app
#COPY . /app/
#RUN ln -s /app/cmd /usr/local/bin/cmd

WORKDIR /app
