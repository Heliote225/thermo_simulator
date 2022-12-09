from PIL import Image
from PIL import ImageDraw
from PIL import ImageFont
import random
import time

import ST7735

disp = ST7735.ST7735(port=0, cs=0, dc=24, backlight=None, rst=25, width=128, height=160, rotation=0, invert=False)
disp.begin()

WIDTH = disp.width
HEIGHT = disp.height

img = Image.new('RGB', (WIDTH, HEIGHT))
draw = ImageDraw.Draw(img)

# Load default font.
#font = ImageFont.load_default()
font = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 35)
font2 = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 40)
font3 = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 20)
font4 = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 10)
# Load an image.
image = Image.open('/home/pi/Desktop/temperature.png')

# Resize the image and rotate it so matches the display.
image = image.rotate(0).resize((72, 72))
#image = image.reduce(2, box=None)




while True:
    try:
        #reading of values in a file
        fichier = open("/var/www/html/courant.txt", "r")
        ch=fichier.readline()
        fichier.close()
        #delete the content of the file
        fichier = open("/var/www/html/courant.txt", "w")
        fichier.close()
        ch=ch.split(' ')
        if(len(ch)==2 or type_valeur!='I'):
            valeur=ch[0]
            type_valeur=ch[1]
        if('.' not in valeur):
            valeur+='.0'
        if(type_valeur=='G' and len(valeur)<4):
            valeur+="0"
    except:
        valeur=''
        type_valeur=''
        
    if(valeur=='' or type_valeur==''):
        time.sleep(2)
        pass
    elif(type_valeur=='T'):
        # Draw a black filled box to clear the image.
        draw.rectangle((0, 0, WIDTH, HEIGHT), outline=0, fill=(0,0,0))
        #printing date and time
        draw.text((20, 1), str(time.strftime("%d-%m-%Y   %H:%M")), font=font4, fill=(255, 255, 255))
        
        
        draw.rectangle((9, 20, 120, 56), outline=0, fill=(26,82,118))
        # Write some text
        draw.text((12, 21), str(valeur)+"°C", font=font, fill=(255, 255, 255))

        # Write buffer to display hardware, must be called to make things visible on the
        # display!
        img.paste(image,(27,70))
        disp.display(img)
        
        
        
        # Draw the image on the display hardware.
        #the temperature changes after 5 seconds
        time.sleep(5)
    elif(type_valeur=='H'):
    
        # Draw a black filled box to clear the image.
        draw.rectangle((0, 0, WIDTH, HEIGHT), outline=0, fill=(0,0,0))
        draw.text((20, 1), str(time.strftime("%d-%m-%Y   %H:%M")), font=font4, fill=(255, 255, 255))
        
        draw.rectangle((9, 110, 120, 135), outline=0, fill=(26,82,118))
        #draw.ellipse((104, 100, 25, 25), raduis=2, width=2, outline=0, fill=(150,100,200))
        # Write some text
        draw.text((18, 112), "HCT: "+str(random.uniform(35.0,67.0))[:2]+"%", font=font3, fill=(255, 255, 255))

        # Write buffer to display hardware, must be called to make things visible on the
        # display!
        draw.text((10, 55), str(valeur), font=font2, fill=(255, 255, 255))
        draw.text((8, 24), "Hb", font=font3, fill=(255, 255, 255))
        draw.text((90, 70), "g/dL", font=font3, fill=(255, 255, 255))
        disp.display(img)
        
        
        # Draw the image on the display hardware.
        #the temperature changes after 5 seconds
        time.sleep(2)
    elif (type_valeur=='I'):
        for i in range(4):
            # Draw a black filled box to clear the image.
            draw.rectangle((0, 0, WIDTH, HEIGHT), outline=0, fill=(0,0,0))
            draw.text((20, 1), str(time.strftime("%d-%m-%Y   %H:%M")), font=font4, fill=(255, 255, 255))
          
            # Write buffer to display hardware, must be called to make things visible on the
            # display!
            draw.text((29, 25), 'Mesure', font=font3, fill=(255, 255, 255))
            draw.text((52, 50), "en", font=font3, fill=(255, 255, 255))
            draw.text((40, 75), "cours", font=font3, fill=(255, 255, 255))
            draw.text((56, 100), "."*i, font=font3, fill=(255, 255, 255))
            disp.display(img)
            time.sleep(0.7)
        
    else:
        # Draw a black filled box to clear the image.
        draw.rectangle((0, 0, WIDTH, HEIGHT), outline=0, fill=(0,0,0))
        draw.text((20, 1), str(time.strftime("%d-%m-%Y   %H:%M")), font=font4, fill=(255, 255, 255))
        
        draw.rectangle((55, 110, 120, 135), outline=0, fill=(26,82,118))
        #draw.ellipse((104, 100, 25, 25), raduis=2, width=2, outline=0, fill=(150,100,200))
        # Write some text
        #draw.text((18, 112), "HCT: "+str(random.uniform(35.0,67.0))[:2]+"%", font=font3, fill=(255, 255, 255))

        # Write buffer to display hardware, must be called to make things visible on the
        # display!
        draw.text((20, 55), str(valeur), font=font2, fill=(255, 255, 255))
        draw.text((8, 24), "Gly", font=font3, fill=(255, 255, 255))
        draw.text((75, 110), "g/L", font=font3, fill=(255, 255, 255))
        disp.display(img)
        
        
        # Draw the image on the display hardware.
        #the temperature changes after 5 seconds
        time.sleep(2)
    
    
