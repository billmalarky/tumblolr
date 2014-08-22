#!/bin/sh

##############
############## IMPORTANT STEPS FOR RUNNING VAGRANT ON WINDOWS 7
############## Start up virtualbox in admin mode by right clicking on virtualbox and clicking "run as administrator" and then open up cygwin terminal as an administrator as well. Both programs must be run as admin for symlinking to work correctly on windows 7.
##############

SITE_DIR="/var/www/html/tumblrtest.local" # The path to the web application on the server (default: /var/www/html)
SITE_PUB_DIR="/var/www/html/tumblrtest.local/public" # The path to the application public web folder.
VAGRANT_DATA_DIR="/vagrant/vagrant"
DB_NAME="tumblrtest" #name of mysql DB.






yum update -y
#yum install -y postgresql-server.x86_64
#postgresql-setup initdb
#service postgresql start
#chkconfig postgresql on
#rm -f /var/lib/pgsql/data/postgresql.conf #use vagrant postgresql config
#ln -s $VAGRANT_DATA_DIR/postgresql/postgresql.conf /var/lib/pgsql/data/postgresql.conf
#rm -f /var/lib/pgsql/data/pg_hba.conf #use vagrant pg_hba config
#ln -s $VAGRANT_DATA_DIR/postgresql/pg_hba.conf /var/lib/pgsql/data/pg_hba.conf

#create postgresql DB user and database
#su postgres
#psql -f $VAGRANT_DATA_DIR/postgresql/tumblrtest-db-init.backup
#exit
#runuser -l postgres -c 'psql -f /vagrant/vagrant/postgresql/tumblrtest-db-init.backup'

#Add tumblrtest user to linux system so laravel can connect via ident instead of trust
# This shouldn't be needed anymore since I updated pg_hba.conf to trust mode. 
# If need user account, just use username vagrant pass vagrant
#USERNAME="tumblrtest"
#PASSWORD="tumblrtest"
#PASS=$(perl -e 'print crypt($ARGV[0], "password")' $PASSWORD)
#useradd -G vagrant -m -p $PASS $USERNAME

yum install -y nginx
yum install -y php-fpm
yum install -y php-dom
yum install -y php-mcrypt
yum install -y php-gd
yum install -y php-pdo
#yum install -y php-pgsql
yum install -y php-mysql 
#yum install -y php-soap
yum install -y git
yum install -y vim

# Setting up Python and OpenCV
#yum install -y numpy opencv*
#yum install -y python-ipython
#yum install -y cmake
#yum install -y python-devel
#yum install -y gtk2-devel
#yum install -y libdc1394-devel
#yum install -y libv4l-devel
#yum install -y gstreamer-plugins-base-devel
#yum install -y libjpeg-turbo-devel
#yum install -y jasper-devel
#yum install -y openexr-devel
#yum install -y libtiff-devel
#yum install -y libwebp-devel

# Install RPM fusion repo to get access to ffmpeg package.
#rpm -Uvh http://download1.rpmfusion.org/free/fedora/rpmfusion-free-release-19.noarch.rpm
#yum install -y ffmpeg
#yum install -y ffmpeg-devel
#yum install -y gstreamer-ffmpeg
#yum install -y gstreamer-python
#yum install -y gstreamer-python-devel
#yum install -y gstreamer-plugins-good.x86_64 gstreamer-plugins-bad.x86_64 gstreamer-plugins-bad-free.x86_64 gstreamer-plugins-bad-free-extras.x86_64 gstreamer-plugins-base.x86_64 gstreamer-plugins-base-devel.x86_64 gstreamer-plugins-good-extras.x86_64 gstreamer-plugins-ugly.x86_64

#yum install -y valgrind #segmentation fault debugger.

# Install Xfce desktop
#yum install -y screen # so we can start the desktop environment as a background task in our SSH session.
#yum groups install -y "Xfce Desktop"
#yum install -y VirtualBox-guest.x86_64
# Now Xfce can be started with the command: startxfce4


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
#chown -R vagrant:vagrant /var/lib/php/session

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
#service postgresql restart


echo "Server provisioning complete!"