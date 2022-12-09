import RPi.GPIO as GPIO #Importe la bibliothèque pour contrôler les GPIOs
from PIL import Image
from PIL import ImageDraw
from PIL import ImageFont
import time

import ST7735

# Load font
font = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 20)
font1 = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 10)
# Load an image.
image = Image.open('/home/pi/Desktop/logo_sante.jpg')


GPIO.setmode(GPIO.BCM) #Définit le mode de numérotation (Board)
GPIO.setwarnings(False) #On désactive les messages d'alerte

ECRAN = 4 #Définit le numéro du port GPIO qui alimente la led

GPIO.setup(ECRAN, GPIO.OUT) #Active le contrôle du GPIO

GPIO.output(ECRAN, GPIO.HIGH) #On l'allume l'écran

disp = ST7735.ST7735(port=0, cs=0, dc=24, backlight=None, rst=25, width=128, height=160, rotation=0, invert=False)
disp.begin()

WIDTH = disp.width
HEIGHT = disp.height

img = Image.new('RGB', (WIDTH, HEIGHT))
draw = ImageDraw.Draw(img)


img = Image.new('RGB', (WIDTH, HEIGHT))
draw = ImageDraw.Draw(img)

# Draw a black filled box to clear the image.
draw.rectangle((0, 0, WIDTH, HEIGHT), outline=0, fill=(0,0,0))
#printing date and time
draw.text((20, 1), str(time.strftime("%d-%m-%Y   %H:%M")), font=font1, fill=(255, 255, 255))

draw.rectangle((9, 20, 120, 56), outline=0, fill=(26,82,118))
# Write some text
draw.text((20, 26), "Welcome!", font=font, fill=(255, 255, 255))

# Write buffer to display hardware, must be called to make things visible on the
# display!
img.paste(image,(18,60))
disp.display(img)