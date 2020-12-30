# Importing libraries
import RPi.GPIO as GPIO
import time
import string
import led

returnVal = ""

# Defining matrix variables for gpio pins
ROW = [2, 3, 4, 17]
COL = [14, 15, 18, 23]

# Switch off warnings
GPIO.setwarnings(False)
# Setting pin numbering to BCM
GPIO.setmode(GPIO.BCM)

# Setting pins in the ROW matrix to GPIO.OUT
for i in range(4):
    GPIO.setup(ROW[i], GPIO.OUT)
    
# Setting pins in the COL matrix to GPIO.IN, and setting a digital pulldown on
for j in range(4):
    GPIO.setup(COL[j], GPIO.IN, pull_up_down = GPIO.PUD_DOWN)

def getKeypad():
    returnVal = ""
    time.sleep(0.3)
    #First row
    GPIO.output(ROW[0], GPIO.HIGH)
    if(GPIO.input(COL[0]) == 1):
        return "1"
    if(GPIO.input(COL[1]) == 1):
        return "2"
    if(GPIO.input(COL[2]) == 1):
        return "3"
    if(GPIO.input(COL[3]) == 1):
        return "A"
    GPIO.output(ROW[0], GPIO.LOW)
    #Second row
    GPIO.output(ROW[1], GPIO.HIGH)
    if(GPIO.input(COL[0]) == 1):
        return "4"
    if(GPIO.input(COL[1]) == 1):
        return "5"
    if(GPIO.input(COL[2]) == 1):
        return "6"
    if(GPIO.input(COL[3]) == 1):
        return "B"
    GPIO.output(ROW[1], GPIO.LOW)
    #Third row
    GPIO.output(ROW[2], GPIO.HIGH)
    if(GPIO.input(COL[0]) == 1):
        return "7"
    if(GPIO.input(COL[1]) == 1):
        return "8"
    if(GPIO.input(COL[2]) == 1):
        return "9"
    if(GPIO.input(COL[3]) == 1):
        return "C"
    GPIO.output(ROW[2], GPIO.LOW)
    #Fourth row
    GPIO.output(ROW[3], GPIO.HIGH)
    if(GPIO.input(COL[0]) == 1):
        return "*"
    if(GPIO.input(COL[1]) == 1):
        return "0"
    if(GPIO.input(COL[2]) == 1):
        return "#"
    if(GPIO.input(COL[3]) == 1):
        return "D"
    GPIO.output(ROW[3], GPIO.LOW)


    
