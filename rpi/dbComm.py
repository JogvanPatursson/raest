import mysql.connector
from mysql.connector import Error
from mysql.connector import errorcode
from datetime import datetime

#Stores measurement for temperature and humidity to database
def addData(t, h, time):
    try:
        raestdb = mysql.connector.connect(
            host = "localhost",
            user = "raest",
            password = "raest",
            database = "raest_db"
        )

        sqlStatement =  "INSERT INTO climate(temperature, humidity, climate_time) VALUES (%s, %s, %s)"
        myCursor = raestdb.cursor()
        myCursor.execute(sqlStatement, (t, h, time))
        raestdb.commit()
        raestdb.close()
        myCursor.close()

    except mysql.connector.Error as error:
        print("Error: ".format(error))
        
# Retrieves measurements from database for temperature and humidity 
def getData():
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    sqlStatement = "SELECT temperature FROM climate"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement)
    
    myResult = myCursor.fetchall()
    
    for row in myResult:
        print("Temperature: ", end = "")
        print(row)
    
    raestdb.close()
    myCursor.close()

# 
def addUser():
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    sqlStatement = "INSERT INTO user (user_name, password, rfid_key) VALUES ('TestName', '1234', '1B3A102C');"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement)
    print("SQL statement executed")
    raestdb.close()
    myCursor.close()

def addMotion(m, time):
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    sqlStatement = "INSERT INTO motion (motion, time) VALUES (%s, %s)"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement, (m, time))
    raestdb.commit()
    raestdb.close()
    myCursor.close()

# Checks if rfid is stored in database
def loginAuth(rfid, password):
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    # Selecting the password column from the user table where rfid_key matches rfid input
    sqlStatement = "SELECT rfid_key, password FROM user"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement, rfid)
    myResult = myCursor.fetchall()
    #myResultStr = myResult.decode('utf-8')
    raestdb.close()
    myCursor.close()
    #print(myResultStr)
    for row in myResult:
        r = row[0].decode()
        p = row[1].decode()
        
        if (rfid == r):
            if (password = p):
                return True
            else:
                return False
    # Traverse every row in column of rfid_key
    #for row in myResult:
        # Compare rfid with stored rfid_key in row
    #if(myResultStr == password):
        #print("Correct")
        #return True
    #else:
        #print("False")
        #return False

# Checks if password is stored in database
def inventoryAuth(rfid, password):
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    # Selecting the rfid_key column from the user table
    sqlStatement = "SELECT user_name, password FROM user"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement)
    
    
    myResult = myCursor.fetchall()
    #myResult = myCursor.fetchone()[0].decode()
    
    for row in myResult:
        u = row[0].decode()
        p = row[1].decode()
        if(p == password):
            inventoryWithdraw(rfid, u)
    
    return False

def inventoryWithdraw(rfid, user):
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    
            
# Add photo name and timestamp to database
def addPhoto(name, time):
    try:
        raestdb = mysql.connector.connect(
            host = "localhost",
            user = "raest",
            password = "raest",
            database = "raest_db"
        )
        #time = '2020-12-04 12:30:45'
        #name = "jogvan"

        print("Name; ")
        print(name)
        print("time: ")
        print(time)
        sqlStatement = "INSERT INTO motion (motion_name, motion_time) VALUES(%s, %s)"
        myCursor = raestdb.cursor()

        myCursor.execute(sqlStatement, (name, time))
        raestdb.commit()
        raestdb.close()
        myCursor.close()

    except mysql.connector.Error as error:
        print("Error: ".format(error))
