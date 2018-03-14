#!/bin/bash

if [ "$EUID" -ne 0 ]
  then echo "Please run setup.sh with sudo."
  exit
fi

apt-get install -y git unzip apache2 mysql-server
apt-get install -y php5 php5-curl php5-mysql

a2enmod rewrite
a2dissite 000-default

mkdir /var/log/apache2/eyebeam.org
ln -s /var/log/apache2/eyebeam.org /home/vagrant/logs

ln -s /var/www/eyebeam.org/develop/apache-vhost.conf /etc/apache2/sites-enabled/eyebeam.org.conf
service apache2 restart

curl -o /var/www/eyebeam.org/wordpress.zip https://wordpress.org/latest.zip
unzip /var/www/eyebeam.org/wordpress.zip -d /var/www/eyebeam.org
mv /var/www/eyebeam.org/wordpress/* /var/www/eyebeam.org/
rm -rf /var/www/eyebeam.org/wordpress
