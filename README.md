# thermo_simulator
Hi everyone!
Do you want to try our thermometer, Hemecue and glucometer simulator?
Here we will use (raspberry pi + ST7735 screen + pushing button)
After connecting all the devices quoted above, you should follow those steps to deploy the program correctly in the raspberry pi

STEP 1
  download if it not already done this repository using: git clone https://github.com/Heliote225/thermo_simulator

STEP 2
  enter into the folder thermo_simulator using: cd thermo_simulator
  
STEP 3
  enable the execution the file configuration.sh using: sudo chmod +x configuration.sh
  launch file configuration.sh using: ./configuration.sh
  this configuration file install automatically an apache server if it does not exist and also install php+mysql automatically
  So at this level, our webserver+php+mysql are well installed
   
STEP 4
  if you want to automate the launching of the python code when the raspberry pi start just do:
      -copy this in the file /etc/rc.local just before the line 'exit 0':
          /usr/bin/python3 /home/pi/Desktop/on_off.py &
          /usr/bin/python3 /home/pi/Desktop/affichage.py &
  restart the raspberry pi

STEP 5
  now, you can delete le folder thermo_simulator using: rm -rf thermo_simulator/

Now the project is correctly deployed!

All you have to do now is opening a navigator on another device (Computer or Mobile phone) and enter the local ip adress of your raspberry pi.

Have fun!!!
