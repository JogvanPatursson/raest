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
from rfid import rfidClass

rfid = "RFID: "
motion = "Motion: "
t = "t: "
h = "h: "

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
    
        
        if (rfid in line):
            rfidInput = line.replace(rfid, "")
            print("RFID in line: ", rfidInput)
            rfidClass().rfidHandler(rfidInput)
        
        if (t in line):
            tInput = line.replace(t, "")
		
        if (h in line):
            hInput = line.replace(h, "")
		
        if (motion in line):
            motionInput = line.replace(motion, "")
            
            done = time.time()
            elapsed = done - start
            
            
            if (elapsed > 60):
                motionFlag = False
            
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
        current_time = now.strftime("%Y-%m-%d %H:%M:%S")
        #print(current_time)
        current_minute = int(current_minute)
        #print(current_minute)
        
        if (dataFlag == False):
            if ((current_minute % 10) == 0):
                #if (tInput != None and hInput != None):
                #print(tInput, hInput, currentTime, end = " ")
                dbComm.addData(tInput, hInput, current_time)
                #tInput = ""
                #hInput = ""

                
                dataFlag = True
                    
        if ((current_minute % 10) == 2):
            dataFlag = False
        #**********************************************************
        
