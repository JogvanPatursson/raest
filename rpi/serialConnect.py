import serial


ser = serial.Serial('/dev/ttyUSB0', 9600, timeout=1)

string = "request"
encodedString = string.encode()
ser.write(encodedString)
