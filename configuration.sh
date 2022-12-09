#!/bin/bash  
echo "Beginning of configuration"
echo "Installing Apache2 server and configuring it"
sudo apt update
sudo apt upgrade
sudo apt update
sudo apt install apache2
sudo chown -R pi:www-data /var/www/html/
sudo apt install php php-mbstring
sudo apt install mariadb-server php-mysql
sudo chmod -R 770 /var/www/html/
echo "Done" 
echo "Configuration of the database measure_db"
sudo chmod +x data.sql
sudo mysql --user=root < data.sql
echo "Done"
echo "Moving of the python files to /home/pi/Desktop/"
sudo chmod 777 *
sudo chmod 777 ./html/*
sudo chmod 777 /var/www/html
mv *.py /home/pi/Desktop/ 
mv *.png /home/pi/Desktop/ 
mv *.jpg /home/pi/Desktop/ 
mv *.ttf /home/pi/Desktop/
echo "Done" 
echo "Moving of html/ to /var/www/" 
sudo rm -rf /var/www/html
sudo mv html/ /var/www/
echo "Done" 
echo "configuration done succesfully!"  
