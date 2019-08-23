FROM php:7.3-apache

# ------------------------------------------------------------------------------
# Criar diretório
# ------------------------------------------------------------------------------
WORKDIR /var/www/app

# ------------------------------------------------------------------------------
# Instalação de pacotes
# ------------------------------------------------------------------------------

RUN apt-get update
RUN apt-get install -y zlib1g-dev \
   libxml2-dev \
   nano \
   cron \
   curl \
   libzip-dev \
   libpng-dev \
   libpq-dev \
   libc-client-dev \
   libkrb5-dev \
   wget \
   supervisor \
   git \
   gnupg \
   bzip2 \
   freetds-bin \
   freetds-dev \
   freetds-common \
   rsync && \
   apt-get clean -y

# ------------------------------------------------------------------------------
# Habilitação de extensões php
# ------------------------------------------------------------------------------
RUN docker-php-ext-install pdo_pgsql pgsql pdo_mysql mysqli

# ------------------------------------------------------------------------------
# Instalar o composer
# ------------------------------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# ------------------------------------------------------------------------------
# Instalar o Redis
# ------------------------------------------------------------------------------
RUN \
  cd /tmp && \
  wget http://download.redis.io/redis-stable.tar.gz && \
  tar xvzf redis-stable.tar.gz && \
  cd redis-stable && \
  make && \
  make install && \
  cp -f src/redis-sentinel /usr/local/bin && \
  mkdir -p /etc/redis && \
  cp -f *.conf /etc/redis && \
  rm -rf /tmp/redis-stable* && \
  sed -i 's/^\(bind .*\)$/# \1/' /etc/redis/redis.conf && \
  sed -i 's/^\(daemonize .*\)$/# \1/' /etc/redis/redis.conf && \
  sed -i 's/^\(dir .*\)$/# \1\ndir \/data/' /etc/redis/redis.conf && \
  sed -i 's/^\(logfile .*\)$/# \1/' /etc/redis/redis.conf

# ------------------------------------------------------------------------------
# ServerName para evitar erros
# ------------------------------------------------------------------------------
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf && a2enmod rewrite ssl

CMD ["/usr/bin/supervisord"]