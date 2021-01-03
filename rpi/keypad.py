# Importing libraries
import RPi.GPIO as GPIO
import time
import string
import led

# Pin numbers for rows and columns of keypad
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

# Returns user selected key
def getKeypad():
    # Sleep for 0.3 seconds to avoid multiple 
    time.sleep(0.3)
    # Sets first row to high. Checks if any column on that row is has an input. Then sets row to low.
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
    # Sets second row to high. Checks if any column on that row is has an input. Then sets row to low.
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
    # Sets third row to high. Checks if any column on that row is has an input. Then sets row to low.
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
    # Sets fourth row to high. Checks if any column on that row is has an input. Then sets row to low.
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
