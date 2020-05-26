#!/bin/bash

if [ "$EUID" -ne 0 ]
  then echo "Please run with admin privs: sudo ./update_db.sh"
  exit
fi

echo "Setting up database"
cd /var/www/eyebeam.org/develop
curl -O https://staging.eyebeam.org/develop/dev_eyebeam_org.sql.zip
unzip -q dev_eyebeam_org.sql.zip
echo "DROP DATABASE eyebeam_a;" | /Applications/Ampps/mysql/bin/mysql -u root -p"mysql"
echo "CREATE DATABASE eyebeam_a;" | /Applications/Ampps/mysql/bin/mysql -u root -p"mysql"
/Applications/Ampps/mysql/bin/mysql -u root -p"mysql" eyebeam_a < dev_eyebeam_org.sql
/Applications/Ampps/mysql/bin/mysql -u root -p"mysql" eyebeam_a < replace_urls.sql
rm dev_eyebeam_org.sql
rm dev_eyebeam_org.sql.zip

echo "Finished updating database"

echo "Setting up wp-content/uploads"
cd ~/www/eyebeam.local/wp-content/uploads
curl -O https://staging.eyebeam.org/wp-content/uploads/2020_05_26.zip
unzip -q 2020_05_26.zip
rm 2020_05_26.zip

echo "Finished updating uploads"
