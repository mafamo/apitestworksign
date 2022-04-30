FROM php:8.1-apache

RUN apt-get update \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
	software-properties-common \
	&& apt-get update \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y \
	libfreetype6-dev \
	libicu-dev \
    libssl-dev \
    libcurl4-openssl-dev \
	libjpeg62-turbo-dev \
	libmcrypt-dev \
	libedit-dev \
	libedit2 \
	libxslt1-dev \
    libc-client-dev \
	apt-utils \
	gnupg \
	nano \
	default-mysql-client \
	git \
	vim \
	wget \
	curl \
	lynx \
	psmisc \
	unzip \
	tar \
	cron \
	bash-completion \
    libonig-dev \
    libzip-dev \
    libkrb5-dev \
	&& apt-get clean

#Node
RUN echo "deb https://deb.nodesource.com/node_16.x bullseye main" > /etc/apt/sources.list.d/nodesource.list \
    && curl -Ss https://deb.nodesource.com/gpgkey/nodesource.gpg.key | gpg --dearmor | apt-key add - \
    && apt-get update \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    nodejs \
    && apt-get clean

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Xdebug
RUN yes | pecl install xdebug

RUN docker-php-ext-configure \
  	gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/; \
    docker-php-ext-configure \
    imap --with-kerberos --with-imap-ssl; \
	docker-php-ext-install \
  	opcache \
  	gd \
  	bcmath \
  	intl \
  	pdo_mysql \
  	soap \
  	zip \
    imap

#Mailhog Sendmail
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install golang-go \
   && mkdir /opt/go \
   && export GOPATH=/opt/go \
   && go get github.com/mailhog/mhsendmail

ADD ./config/virtualhost.conf /etc/apache2/sites-available/000-default.conf
# ADD ./config/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
ADD ./config/php.ini /usr/local/etc/php/php.ini
COPY ./bin/* /usr/local/bin/
RUN chmod +x /usr/local/bin/* \
    && chown -Rf www-data:www-data /var/www /var/www/.* \
	&& usermod -u 1000 www-data \
    && groupmod -g 1000 www-data \
	&& chsh -s /bin/bash www-data\
	&& a2enmod rewrite \
	&& a2enmod headers

VOLUME /var/www/html
WORKDIR /var/www/html
