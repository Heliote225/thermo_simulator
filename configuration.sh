#!/bin/bash  
echo "Beginning of configuration"
echo "Installing Apache2 server and configuring it"
sudo apt update
sudo apt upgrade
sudo apt update
sudo apt install apache2
sudo chown -R pi:www-data /var/www/html/
sudo chmod -R 770 /var/www/html/
echo "Moving of the python files to /home/pi/Desktop/"
sudo chmod 777 *
sudo chmod 777 ./html/*
sudo chmod 777 /var/www/html
mv *.py /home/pi/Desktop/ 
mv *.png /home/pi/Desktop/ 
mv *.jpg /home/pi/Desktop/ 
mv *.ttf /home/pi/Desktop/
echo "Moving of html/ to /var/www/" 
sudo rm -rf /var/www/html
sudo mv html/ /var/www/
echo "configuration done succesfully!"  
#SOMEVAR='text stuff'  
#echo "$SOMEVAR"
