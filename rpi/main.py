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
        line = ser.readline().decode('utf-8').rstrip()
        print(line)

        string = "request"
        encodedString = string.encode()
        ser.write(encodedString)
    
        
        if (rfidStr in line):
            rfidInput = line.replace(rfidStr, "")
            led.blueBlink()
            rfid.rfidHandler(rfidInput)
        
        if (tempStr in line):
            tInput = line.replace(tempStr, "")
		
        if (humidStr in line):
            hInput = line.replace(humidStr, "")
		
        if (motionStr in line):
            motionInput = line.replace(motionStr, "")
            
            done = time.time()
            elapsed = done - start
	    # If more than 60 seconds have passed since last time motionFlag was set to true
            if (elapsed > 60):
                motionFlag = False
            
            if (motionInput == '1'):
                # Call takePhoto() function, and set motionFlag to true
                if (motionFlag == False):
                    camera.takePhoto()
                    start = done
                    motionFlag = True

        #*********************************************************
        
        # Send temperature and humidity data to database
        now = datetime.now()
        current_minute = now.strftime("%M")
        current_minute = int(current_minute)
        
        if (dataFlag == False):
            if ((current_minute % 10) == 0):
                dbComm.addData(tInput, hInput)
                dataFlag = True
        if ((current_minute % 10) == 2):
            dataFlag = False

    
