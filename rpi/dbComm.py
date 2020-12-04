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
        print("SQL statement executed: VALUES(" + t + ", " + h + ", " + time + ")")
        raestdb.close()
        myCursor.close()

    except mysql.connector.Error as error:
        print("Error: ".format(error))

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

def getTimestamp():
    now = datetime.now()
    timestamp = now.strftime("%Y-%m-%d %H:%M:%S")
    print(timestamp)

#getTimestamp()

#addData(12.41, 30.12, '2020-12-04 12:30:45')

#getData()
#addUser()

