#!/bin/sh

### IMPORTANT STEPS FOR RUNNING VAGRANT ON WINDOWS 7
### Start up virtualbox in admin mode by right clicking on virtualbox and clicking "run as administrator" and then open up cygwin terminal as an administrator as well. Both programs must be run as admin for symlinking to work on windows 7.

SITE_DIR="/var/www/html/tumblolr.local" # The path to the web application on the server (default: /var/www/html)
SITE_PUB_DIR="/var/www/html/tumblolr.local/public" # The path to the application public web folder.
VAGRANT_DATA_DIR="/vagrant/vagrant"
DB_NAME="tumblolr" #name of mysql DB.






#yum update -y
yum install -y expect

#Install mysql/mariadb
yum install -y mysql mysql-server
service mysqld start



# Install nginx and php-fpm
yum install -y nginx
yum install -y php-fpm
yum install -y php-dom
yum install -y php-mcrypt
yum install -y php-gd
yum install -y php-pdo
yum install -y php-mysql 
yum install -y php-soap
yum install -y git
yum install -y vim

# Setting up Xdebug
yum install -y php-devel
yum install -y php-pear
yum install -y gcc gcc-c++ autoconf automake
pecl install Xdebug

# Install xdebug.ini file.
# Note that xdebug.ini xdebug.remote_host=ip.num.goes.here may need to be updated to reach host machine.
# Run this command to find host machine IP address.
# netstat -rn | grep "^0.0.0.0 " | cut -d " " -f10
# More info: http://stackoverflow.com/a/19940738
ln -s $VAGRANT_DATA_DIR/php/xdebug.ini /etc/php.d/xdebug.ini


# Install configured php.ini
cp /etc/php.ini /etc/php.ini.orig
rm -f /etc/php.ini
ln -s $VAGRANT_DATA_DIR/php/php.ini /etc/php.ini

# Installing Composer - Run composer like "/usr/local/bin/composer update"
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

#echo "Symlinking site ..."
#rm -rf /var/www/html #delete html folder so the symlink will recreate it correctly (folder recreated as link).
ln -s /vagrant $SITE_DIR
#ln -s $VAGRANT_DATA_DIR/adminer-4.1.0.php $SITE_PUB_DIR/dbadmin.php #symlink Adminer

# Updating session folder permissions
chown -R vagrant:vagrant /var/lib/php/session
chmod -R 0777 /var/lib/php/session

mv /etc/nginx /etc/nginx-orig
ln -s $VAGRANT_DATA_DIR/nginx/server-configs-nginx-master /etc/nginx
ln -s /etc/nginx/sites-available/tumblolr.local /etc/nginx/sites-enabled/tumblolr.local
mkdir -p /usr/share/nginx/logs # nginx requires this folder to place a "static.log" file in...

mv /etc/php-fpm.d/www.conf /etc/php-fpm.d/www.conf.orig
ln -s $VAGRANT_DATA_DIR/php/www.conf /etc/php-fpm.d/www.conf

# Disabling the development firewall (commented bc iptables not installed by default on this box)
systemctl stop firewalld.service
################Figure out how to turn this off on system restart!!!!
#service iptables stop
#chkconfig iptables off
#chkconfig iptables --del

# Reload services
service nginx restart
service php-fpm restart
service mysqld restart

#run composer install
cd /vagrant
php /usr/local/bin/composer install

# Build DB structure via migration
php /vagrant/app/migrations/install-0.0.1.php

echo "Server provisioning complete!"