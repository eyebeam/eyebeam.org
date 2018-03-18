#!/bin/bash

if [ "$EUID" -ne 0 ]
  then echo "Please run with admin privs: sudo ./setup_vagrant.sh"
  exit
fi

apt-get install -y -q apg
mysql_password=`apg -a 1 -M nL -n 1`

echo "Installing dependencies"
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password '"${mysql_password}"
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password '"${mysql_password}"
apt-get install -y -q unzip apache2 mysql-server
apt-get install -y -q php5 php5-curl php5-mysql
a2enmod -q rewrite
a2dissite -q 000-default

echo "Configuring Apache"
mkdir /var/log/apache2/eyebeam.org
ln -s /var/log/apache2/eyebeam.org /home/vagrant/logs
ln -s /var/www/eyebeam.org/develop/apache-vhost.conf /etc/apache2/sites-enabled/eyebeam.org.conf

echo "Downloading WordPress"
cd /var/www/eyebeam.org
curl -o wordpress.zip https://wordpress.org/latest.zip

echo "Installing WordPress"
unzip -q wordpress.zip
rsync -r -q wordpress/ ./
rm wordpress.zip
rm -rf wordpress

echo "Configuring WordPress"
cp wp-config-sample.php wp-config.php
sed -i -e 's|// \*\* MySQL settings|define('"'"'WP_HOME'"'"', '"'"'http://dev.eyebeam.org'"'"');\ndefine('"'"'WP_SITEURL'"'"', '"'"'http://dev.eyebeam.org'"'"');\n\n// ** MySQL settings|' wp-config.php
sed -i -e 's|database_name_here|eyebeam_org|' wp-config.php
sed -i -e 's|username_here|root|' wp-config.php
sed -i -e 's|password_here|'"${mysql_password}"'|' wp-config.php
sed -i -e 's|localhost|127.0.0.1|' wp-config.php
#sed -i -e "s|'WP_DEBUG', false|'WP_DEBUG', true|" wp-config.php

echo "Setting up database"
cd /var/www/eyebeam.org/develop
curl -O https://staging.eyebeam.org/develop/dev_eyebeam_org.sql.zip
unzip -q dev_eyebeam_org.sql.zip
echo "CREATE DATABASE eyebeam_org;" | mysql -u root -p"${mysql_password}"
mysql -u root -p"${mysql_password}" eyebeam_org < dev_eyebeam_org.sql
rm dev_eyebeam_org.sql
rm dev_eyebeam_org.sql.zip

echo "Setting up wp-content/uploads"
cd /var/www/eyebeam.org/wp-content
curl -O https://staging.eyebeam.org/develop/uploads.zip
unzip -q uploads.zip
rm uploads.zip

echo "Restarting Apache"
service apache2 restart

echo "+--------------------------------------------------------+"
echo "|                                                        |"
echo "|   All done!                                            |"
echo "|                                                        |"
echo "|   - Load up http://dev.eyebeam.org/ in a browser       |"
echo "|   - Dashboard: http://dev.eyebeam.org/wp-admin/        |"
echo "|   - Username: eyebeam                                  |"
echo "|     Password: techbyartists                            |"
echo "|                                                        |"
echo "+--------------------------------------------------------+"
