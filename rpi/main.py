# Importing libraries
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

rfidStr = "RFID: "
motionStr = "Motion: "
tempStr = "t: "
humidStr = "h: "

tInput = ""
hInput = ""
rfidInput = ""
motionInput = ""

correctRFID = False
correctPassword = False

rfidFlag = False
dataFlag = False
motionFlag = False

start = time.time()

#Sets all leds to low
led.turnOffAllLed()

if __name__ == '__main__':
    # Serial connection with Arduino
    #ser = serial.Serial('/dev/ttyACM0', 9600, timeout=1)
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
<<<<<<< HEAD
            
            done = time.time()
            elapsed = done - start
            
            
            if (elapsed > 60):
                motionFlag = False
            
=======
            
            done = time.time()
            elapsed = done - start
            
            
            if (elapsed > 60):
                motionFlag = False
            
>>>>>>> e0e87e3fb5a09c5a940545a5b5bd70db1b909e4d
            if (motionInput == '1'):
                # If one minute has passed since the last motion input
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
<<<<<<< HEAD

    
=======
>>>>>>> e0e87e3fb5a09c5a940545a5b5bd70db1b909e4d
