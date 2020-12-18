import led
import dbComm
import keypad
import time

class rfidClass:
    def __init__(self):
        self.storedInput = ""
        self.keypadVar = ""
        self.rfidStart = 0
        self.rfidEnd = 0
        self.rfidElapsed = 0
        self.number = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
        self.success = False
    
    def rfidHandler(self, rfidInput):
    
        #Set timer before while loop starts
        self.rfidStart = time.time()
        
        while True:
            self.keypadVar = keypad.getKeypad()
            
            # If input is "*" then flush storedInput
            if (self.keypadVar == "*"):
                self.storedInput = ""
                return False
        
            # Check if keypadVar contains one of the strings in number array
            for x in self.number:
                if (self.keypadVar == x):
                    led.blueBlink()
            
                # Concatenate keypadVar into storedInput
                #if (self.storedInput):
                    self.storedInput = self.storedInput + self.keypadVar
                    print("Input: ", end = "")
                    print(self.storedInput)
                
                # If user inputs more than 4 numbers, return false
                if (len(self.storedInput) > 4):
                    led.redBlink()
                    self.storedInput = ""
                    return
                    
            # To user enters "#", request database to check rfid and password for login
            if (self.keypadVar == "#"):
                led.blueBlink()
                print("Pressed #")
                print(self.storedInput)
                if (len(self.storedInput) == 4):
                    self.success = dbComm.loginAuth(rfidInput, self.storedInput)
                    print(self.success)
                    if (self.success == True):
                        led.greenBlink()
                        self.storedInput = ""
                        return
                    else:
                        led.redBlink()
                        self.storedInput = ""
                        return
                else:
                    self.storedInput = ""
                    led.redBlink()
                    return
                    
            # If user enters "A", request database to log item withdraw
            if (self.keypadVar == "A"):
                led.blueBlink()
                print("Pressed A")
                if (len(self.storedInput) == 4):
                    if (dbComm.withdrawItem(rfidInput, self.storedInput)):
                        led.greenBlink()
                        self.storedInput = ""
                        return
                    else:
                        led.redBlink()
                        self.storedInput = ""
                        return
                else:
                    self.storedInput = ""
                    led.redBlink()
                    
            self.rfidEnd = time.time()
            self.rfidElapsed = self.rfidEnd - self.rfidStart
        
            # If the timer expires, 
            if (self.rfidElapsed > 10):
                led.redBlink()
                return
        
