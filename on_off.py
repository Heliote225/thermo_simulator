import RPi.GPIO as GPIO #Importe la bibliothèque pour contrôler les GPIOs
from PIL import Image
from PIL import ImageDraw
from PIL import ImageFont
import time
import ST7735

# Load fonts for text
font = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 20)
font1 = ImageFont.truetype("/home/pi/Desktop/arial.ttf", 10)

# Load an image.
image = Image.open('/home/pi/Desktop/logo_sante.jpg')

GPIO.setmode(GPIO.BCM) #defining the numerotation mode (BCM)
GPIO.setwarnings(False) #we lock alert message

ECRAN = 4 #defining the screen of the GPIO that feed the screen

GPIO.setup(ECRAN, GPIO.OUT) #activation of the GPIO control

GPIO.output(ECRAN, GPIO.HIGH) #we put the screen on

#starting of the screen
disp = ST7735.ST7735(port=0, cs=0, dc=24, backlight=None, rst=25, width=128, height=160, rotation=0, invert=False)
disp.begin()

#collecting the screen size
WIDTH = disp.width
HEIGHT = disp.height
img = Image.new('RGB', (WIDTH, HEIGHT))
draw = ImageDraw.Draw(img)

#initializing of the display
img = Image.new('RGB', (WIDTH, HEIGHT))
draw = ImageDraw.Draw(img)

# Draw a black filled box to clear the image.
draw.rectangle((0, 0, WIDTH, HEIGHT), outline=0, fill=(0,0,0))

#printing date and time
draw.text((20, 1), str(time.strftime("%d-%m-%Y   %H:%M")), font=font1, fill=(255, 255, 255))

#drawing a rectangle
draw.rectangle((9, 20, 120, 56), outline=0, fill=(26,82,118))

# Write some text
draw.text((20, 26), "Welcome!", font=font, fill=(255, 255, 255))

# Pasting the image
img.paste(image,(18,60))

# display!
disp.display(img)
