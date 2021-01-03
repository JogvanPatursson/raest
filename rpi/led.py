import RPi.GPIO as GPIO
import time

# Pin number 24 is used for blue LED
BLUE_PIN = 24
# Pin number 25 is used for green LED
GREEN_PIN = 25
# Pin number 8 is used for red LED
RED_PIN = 8

# Switch off warnings
GPIO.setwarnings(False)
# Setting pin numbering to BCM
GPIO.setmode(GPIO.BCM)

# Sets all three pins as output
GPIO.setup(BLUE_PIN, GPIO.OUT)
GPIO.setup(GREEN_PIN, GPIO.OUT)
GPIO.setup(RED_PIN, GPIO.OUT)

# Funciton for turning blue LED on for 0.2 seconds then turning it off
def blueBlink():
	GPIO.output(BLUE_PIN, GPIO.HIGH)
	time.sleep(0.2)
	GPIO.output(BLUE_PIN, GPIO.LOW)	

# Funciton for turning green LED on for 0.2 seconds then turning it off
def greenBlink():
	GPIO.output(GREEN_PIN, GPIO.HIGH)
	time.sleep(0.2)
	GPIO.output(GREEN_PIN, GPIO.LOW)

# Funciton for turning red LED on for 0.2 seconds then turning it off
def redBlink():
	GPIO.output(RED_PIN, GPIO.HIGH)
	time.sleep(0.2)
	GPIO.output(RED_PIN, GPIO.LOW)	

# Function to turn all three LEDs off
def turnOffAllLed():
	GPIO.output(BLUE_PIN, GPIO.LOW)
	GPIO.output(GREEN_PIN, GPIO.LOW)
	GPIO.output(RED_PIN, GPIO.LOW)
