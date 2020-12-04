import RPi.GPIO as GPIO
import time

BLUE_PIN = 24
GREEN_PIN = 25
RED_PIN = 8

# Switch off warnings
GPIO.setwarnings(False)
# Setting pin numbering to BCM
GPIO.setmode(GPIO.BCM)

GPIO.setup(BLUE_PIN, GPIO.OUT)
GPIO.setup(GREEN_PIN, GPIO.OUT)
GPIO.setup(RED_PIN, GPIO.OUT)

def blueBlink():
	GPIO.output(BLUE_PIN, GPIO.HIGH)
	time.sleep(0.2)
	GPIO.output(BLUE_PIN, GPIO.LOW)	
	
def greenBlink():
	GPIO.output(GREEN_PIN, GPIO.HIGH)
	time.sleep(0.2)
	GPIO.output(GREEN_PIN, GPIO.LOW)
	
def redBlink():
	GPIO.output(RED_PIN, GPIO.HIGH)
	time.sleep(0.2)
	GPIO.output(RED_PIN, GPIO.LOW)	

def turnOffAllLed():
	GPIO.output(BLUE_PIN, GPIO.LOW)
	GPIO.output(GREEN_PIN, GPIO.LOW)
	GPIO.output(RED_PIN, GPIO.LOW)
