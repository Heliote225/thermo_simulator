#!/bin/bash  
echo "Beginning of configuration"
echo "Moving of the python files to /home/pi/Desktop/" 
mv *.py /home/pi/Desktop/ 
mv *.png /home/pi/Desktop/ 
mv *.jpg /home/pi/Desktop/ 
mv *.ttf /home/pi/Desktop/
echo "Moving of the html content to /var/www/html/" 
sudo mv html/* /var/www/html/
sudo chmod 777 /var/www/html/*
echo "configuration done succesfully!"  
#SOMEVAR='text stuff'  
#echo "$SOMEVAR"