#!/bin/sh

### IMPORTANT STEPS FOR RUNNING VAGRANT ON WINDOWS 7
### Start up virtualbox in admin mode by right clicking on virtualbox and clicking "run as administrator" and then open up cygwin terminal as an administrator as well. Both programs must be run as admin for symlinking to work on windows 7.

SITE_DIR="/var/www/html/tumblrtest.local" # The path to the web application on the server (default: /var/www/html)
SITE_PUB_DIR="/var/www/html/tumblrtest.local/public" # The path to the application public web folder.
VAGRANT_DATA_DIR="/vagrant/vagrant"
DB_NAME="tumblrtest" #name of mysql DB.






#yum update -y
yum install -y expect

#Install mysql/mariadb
yum install -y mysql mysql-server
service mysqld start

# Run mysql installation expect scripts
#expect $VAGRANT_DATA_DIR/mysql/mysql-secure-install.expect
#expect $VAGRANT_DATA_DIR/mysql/mysql-create-db.expect

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
ln -s /etc/nginx/sites-available/tumblrtest.local /etc/nginx/sites-enabled/tumblrtest.local
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


echo "Server provisioning complete!"
echo "Now you must run sudo /usr/bin/mysql_secure_installation. Set mysql root password to \"root\""
echo "Finally, create DB with mysql -u root -p -e \"create database tumblrtest\""