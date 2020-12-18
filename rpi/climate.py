from datetime import datetime

class climateClass:
    def __innit__(self):
        self.tInput = ""
        self.hInput = ""
        
    
    def climateHandler(self, tInput, hInput):


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
