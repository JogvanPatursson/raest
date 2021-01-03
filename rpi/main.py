# main.py

# Libraries
from datetime import datetime
import RPi.GPIO as GPIO
import serial
import string
import time
import led
import keypad
import dbComm
import camera
import rfid

# String variables for recognizing different data types
rfidStr = "RFID: "
motionStr = "Motion: "
tempStr = "t: "
humidStr = "h: "

# String variables for input
tInput = ""
hInput = ""
rfidInput = ""
motionInput = ""

dataFlag = False
motionFlag = False

# 
start = time.time()

#Sets all leds to low
led.turnOffAllLed()

# Main function
if __name__ == '__main__':
    # Serial connection with Arduino
    ser = serial.Serial('/dev/ttyUSB0', 9600, timeout=1)
    ser.flush()

    while True:
	# Reads serial data from Arduino. Assigns value to string variable line
        line = ser.readline().decode('utf-8').rstrip()
        print(line)
    
        # If line contains string "RFID: ", remove "RFID: " from line
        if (rfidStr in line):
            rfidInput = line.replace(rfidStr, "")
            led.blueBlink()
            rfid.rfidHandler(rfidInput)
        
	# If line contains string "T: ", remove "T: " from line
        if (tempStr in line):
            tInput = line.replace(tempStr, "")
		
	# If line contains string "H: ", remove "H: " from line
        if (humidStr in line):
            hInput = line.replace(humidStr, "")
	
	# If line contains string "MOTION: ", remove "MOTION: " from line
        if (motionStr in line):
            motionInput = line.replace(motionStr, "")
            
            done = time.time()
            elapsed = done - start
	    # If more than 60 seconds have passed since last time motionFlag was set to true
            if (elapsed > 60):
                motionFlag = False
		
            # If motionInput is 1, call takePhoto() function, and set motionFlag to true
            if (motionInput == '1'):
                if (motionFlag == False):
                    camera.takePhoto()
                    start = done
                    motionFlag = True
        
        # Get current minute
        now = datetime.now()
        current_minute = now.strftime("%M")
        current_minute = int(current_minute)
        
	
        if (dataFlag == False):
	    # If the current minute is divisible by 10
            if ((current_minute % 10) == 0):
                dbComm.addData(tInput, hInput)
                dataFlag = True
	# If two minutes have passed, set dataFlag to false
        if ((current_minute % 10) == 2):
            dataFlag = False

    
