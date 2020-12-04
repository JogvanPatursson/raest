# Importing libraries
import RPi.GPIO as GPIO
import serial
import string
import time
import led
import keypad
import dbComm
from datetime import datetime

storedInput = ""
password = "1234"

number = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
letter = ["A", "B", "C", "D"]

rfid = "RFID: "
motion = "Motion: "
t = "t: "
h = "h: "

tInput = ""
hInput = ""

correctRFID = False
correctPassword = False
flag = False

#Sets all leds to low
led.turnOffAllLed()


if __name__ == '__main__':
    # Serial connection with Arduino
    ser = serial.Serial('/dev/ttyACM0', 9600, timeout=1)
    ser.flush()

    while True:
        line = ser.readline().decode('utf-8').rstrip()
        #print(line)
        
        rfidInput = ""

        motionInput = ""
        
        if (rfid in line):
            rfidInput = line.replace(rfid, "")
            
            correctRFID = False
            correctRFID = dbComm.rfidAuth(rfidInput)
            if (correctRFID == True):
                led.greenBlink()
            elif (correctRFID == False):
                led.redBlink()

            #print(rfidInput)
        
        if (t in line):
            tInput = line.replace(t, "")
            print("T: ", end = "")
            print(tInput)
		
        if (h in line):
            hInput = line.replace(h, "")
            print("H: ", end = "")
            print(hInput)
		
        if (motion in line):
            motionInput = line.replace(motion, "")
			
            #print(motionInput)
        #*********************************************************
        
        # Send temperature and humidity data to database
        now = datetime.now()
        current_minute = now.strftime("%M")
        current_time = now.strftime("%Y-%m-%d %H:%M:%S")
        #print(current_time)
        current_minute = int(current_minute)
        #print(current_minute)
        
        if (flag == False):
            if ((current_minute % 10) == 0):
                #if (tInput != None and hInput != None):
                #print(tInput, hInput, currentTime, end = " ")
                dbComm.addData(tInput, hInput, current_time)
                #tInput = ""
                #hInput = ""
                flag = True
                    
        if ((current_minute % 10) == 2):
            flag = False
            
        
        # Get input from keypad
        keypadVar = keypad.getKeypad()
        #time.sleep(0.3)
        #print(keypadVar)
        
        # If input is "*" then flush storedInput
        if (keypadVar == "*"):
            storedInput = ""
        
        # Check if keypadVar contains one of the strings in number array
        for x in number:
            if (keypadVar == x):
                led.blueBlink()
                
                # Concatenate keypadVar into storedInput
                storedInput = storedInput + keypadVar
                print("Input: ", end = "")
                print(storedInput)
                if (len(storedInput) > 4):
                    led.redBlink()
                    storedInput = ""
                
        if (keypadVar == "#"):
            if (len(storedInput) == 4):
                correctPassword = dbComm.passwordAuth(storedInput)
                if (correctPassword):
                    led.greenBlink()
                else:
                    led.redBlink()
                storedInput = ""
            else:
                storedInput = ""

        for y in letter:
            if (storedInput == y):
                led.redBlink()
                storedInput = ""
        #**********************************************************
