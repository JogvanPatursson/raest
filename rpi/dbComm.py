# dbComm.py

# Libraries
import mysql.connector
from mysql.connector import Error
from mysql.connector import errorcode
from datetime import datetime
import led

#Stores measurement for temperature and humidity to database
def addData(t, h):
    try:
        # Connect to raest_db database
        raestdb = mysql.connector.connect(
            host = "localhost",
            user = "raest",
            password = "raest",
            database = "raest_db"
        )
        # Get current timestamp
        now = datetime.now()
        current_time = now.strftime("%Y-%m-%d %H:%M:%S")
        
        # Insert values for temperature, humidity and timestamp to climate table in database
        sqlStatement =  "INSERT INTO climate(temperature, humidity, climate_time) VALUES (%s, %s, %s)"
        myCursor = raestdb.cursor()
        myCursor.execute(sqlStatement, (t, h, current_time))
        raestdb.commit()
        raestdb.close()
        myCursor.close()
        
        # Error message if 
    except mysql.connector.Error as error:
        print("Error: ".format(error))

# Checks if rfid is stored in database, and if password is correct
def loginAuth(rfid, password):
    # Connect to raest_db database
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    # Selecting the password column from the user table where rfid_key matches rfid input
    sqlStatement = "SELECT rfid_key, password, user_id FROM user"
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
        u = row[2]
        # If rfid from user matches rfid from database
        if (rfid == r):
            # If password from user matches password from database 
            if (password == p):
                # Green LED blinks
                led.greenBlink()
                # Add record of access to database
                addAccessLog(u)
            else:
                # Red LED blinks
                led.redBlink()
# 
def addAccessLog(user):
    # Connect to raest_db database
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    now = datetime.now()
    time = now.strftime("%Y-%m-%d %H:%M:%S")
    # Insert record of user and timestamp to access table in database
    sqlStatement = "INSERT INTO access(user_id, access_time) VALUES (%s, %s)"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement, (user, time))
    raestdb.commit()
    raestdb.close()
    myCursor.close()

# Checks if password is stored in database and retrieve user for that password
def inventoryAuth(rfid, password, trans_type):
    # Connect to raest_db database
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    # Selecting the rfid_key column from the user table in database
    sqlStatement = "SELECT user_id, password FROM user"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement)
    
    
    myResult = myCursor.fetchall()
    #myResult = myCursor.fetchone()[0].decode()
    
    # Get user id by checking password in databases
    for row in myResult:
        u = row[0]
        p = row[1].decode()
        if(p == password):
            led.greenBlink
            inventoryTransaction(rfid, u, trans_type)
        else:
            led.redBlink()
            
# Withdraw and deposit item from inventory
def inventoryTransaction(rfid, user_id, trans):
    # Tag for item type, "Grindalykkja"
    tag1 = "97F2BC2"
    # Tag for item type, "Skerpikjot"
    tag2 = "C91F19C2"
    
    # String variables for 
    item_type = ""
    trans_type = ""
    
    # If rfid is tag1 the item type is "Grindalykkja"
    if (rfid == tag1):
        item_type = "Grindalykkja"
    # If rfid is tag2 the item type is "Skerpikjot"
    elif (rfid == tag2):
        item_type = "Skerpikjot"
        
    # If user chose "A" the transaction type is "withdraw"
    if (trans == "A"):
        trans_type = "withdraw"
    # If user chose "B" the transaction type is "deposit"
    elif (trans == "B"):
        trans_type = "deposit"
        
    # Connect to raest_db database
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    # Create datetime
    now = datetime.now()
    currentTime = now.strftime("%Y-%m-%d %H:%M:%S")
    
    # Insert record of withdrawal or deposit to transaction table in database
    sqlStatement = "INSERT INTO transactions(item_id, user_id, item_type, trans_type, trans_date) VALUES(%s, %s, %s, %s, %s)"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement, (rfid, user_id, item_type, trans_type, currentTime))
    raestdb.commit()
    raestdb.close()
    myCursor.close()
    
# Add photo timestamp to database
def addPhoto(time):
    # Connect to raest_db database
    raestdb = mysql.connector.connect(
        host = "localhost",
        user = "raest",
        password = "raest",
        database = "raest_db"
    )
    
    # Insert record of timestamp to motion table in database
    sqlStatement = "INSERT INTO motion(motion_time) VALUES(%s)"
    myCursor = raestdb.cursor()
    myCursor.execute(sqlStatement, (time,))
    raestdb.commit()
    raestdb.close()
    myCursor.close()
