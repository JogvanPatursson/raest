import led
import dbComm
import keypad
import time

def rfidHandler(rfidInput):
    storedInput = ""
    keypadVar = ""
    rfidStart = 0
    rfidEnd = 0
    rfidElapsed = 0
    number = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
    success = False

    #Set timer before while loop starts
    rfidStart = time.time()
    
    while True:
        keypadVar = keypad.getKeypad()
        
        # If input is "*" then flush storedInput
        if (keypadVar == "*"):
            storedInput = ""
            return False
    
        # Check if keypadVar contains one of the strings in number array
        for x in number:
            if (keypadVar == x):
                led.blueBlink()
        
            # Concatenate keypadVar into storedInput
            #if (self.storedInput):
                storedInput = storedInput + keypadVar
                print("Input: ", end = "")
                print(storedInput)
            
            # If user inputs more than 4 numbers, return false
            if (len(storedInput) > 4):
                led.redBlink()
                storedInput = ""
                return
                
        # To user enters "#", request database to check rfid and password for login
        if (keypadVar == "#"):
            led.blueBlink()
            print("Pressed #")
            print(storedInput)
            if (len(storedInput) == 4):
                success = dbComm.loginAuth(rfidInput, storedInput)
                print(success)
                if (success == True):
                    led.greenBlink()
                    storedInput = ""
                    return
                else:
                    led.redBlink()
                    storedInput = ""
                    return
            else:
                storedInput = ""
                led.redBlink()
                return
                
        # If user enters "A" or "B", request database to log item withdraw or deposit
        if ((keypadVar == "A") or (keypadVar == "B")):
            led.blueBlink()
            print("Pressed A or B")
            if (len(storedInput) == 4):
                if (dbComm.inventoryAuth(rfidInput, storedInput, keypadVar)):
                    led.greenBlink()
                    storedInput = ""
                    return
                else:
                    led.redBlink()
                    storedInput = ""
                    return
            else:
                storedInput = ""
                led.redBlink()
                
        rfidEnd = time.time()
        rfidElapsed = rfidEnd - rfidStart
    
        # If the timer expires, 
        if (rfidElapsed > 10):
            led.redBlink()
            return
    
