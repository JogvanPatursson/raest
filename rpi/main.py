# Importing libraries
#import datetime
from datetime import datetime, timedelta
import RPi.GPIO as GPIO
import serial
import string
import time
import led
import keypad
import dbComm
import camera

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
dataFlag = False
motionFlag = False

now = datetime.now()
currentMinute = datetime.now()
lastMinute = datetime.now() - timedelta(minutes=2)

start = time.time()

#Sets all leds to low

if __name__ == '__main__':
    # Serial connection with Arduino
    #ser = serial.Serial('/dev/ttyACM0', 9600, timeout=1)
    ser = serial.Serial('/dev/ttyUSB0', 9600, timeout=1)
    ser.flush()

    while True:
        line = ser.readline().decode('utf-8').rstrip()
        print(line)

        rfidInput = ""
        motionInput = ""
        
        if (rfid in line):
            rfidInput = line.replace(rfid, "")
            
            # 10 seconds to input password
            #t_end = time.time() + 10
            #while time.time() < t_end:
            for i in range(10):
                keypadVar = keypad.getKeypad()
                
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
                        
                # To enter password for login
                if (keypadVar == "#"):
                    if (len(storedInput) == 4):
                        #correctPassword = dbComm.passwordAuth(storedInput)
                        #correctLogin = dbComm.login(rfidInput, storedInput)
                        if (correctPassword):
                            led.greenBlink()
                        else:
                            led.redBlink()
                        storedInput = ""
                    else:
                        storedInput = ""
                        
                # To enter password to withdraw item from inventory
                if (keypadVar == "A"):
                    if (len(storedInput) == 4):
                        dbComm.withdrawItem(rfidInput, storedInput)
                        if ():
                            led.greenBlink()
                        else:
                            led.redBlink()
                        storedInput = ""
                    else:
                        storedInput = ""
                        
            correctRFID = False
            correctRFID = dbComm.rfidAuth(rfidInput)
            if (correctRFID == True):
                print("Correct rifd")
                led.greenBlink()
                
                
            elif (correctRFID == False):
                led.redBlink()
                print("Incorrect rfid")

            #print(rfidInput)
        
        if (t in line):
            tInput = line.replace(t, "")
            #print("T: ", end = "")
            #print(tInput)
		
        if (h in line):
            hInput = line.replace(h, "")
            #print("H: ", end = "")
            #print(hInput)
		
        if (motion in line):
            motionInput = line.replace(motion, "")
            #print(motionInput)
            
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
        
