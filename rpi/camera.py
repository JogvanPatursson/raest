import time
import dbComm
from picamera import PiCamera
from datetime import datetime

# global camera object to be used several times
camera = PiCamera()

def takePhoto():

    now = datetime.now()
    currentTime = now.strftime("%Y-%m-%d %H:%M:%S")
    currentTimeString = str(currentTime)
    extensionString = ".jpg"

    # Sets the resolution and names the photo to be the current timestamp
    camera.resolution = (400, 225)
    camera.capture(currentTimeString + extensionString)

    # Call function to save photo timestamp and location to database
    dbComm.addPhoto(currentTimeString, currentTime)
    
# Circa 66 KB
#camera.resolution = (400, 225)
#camera.capture('400, 225')
    
# Circa 177.5 KB
#camera.resolution = (640, 360)
#camera.capture('640, 360')

# Circa 550 KB
#camera.resolution = (1280, 720)
#camera.capture('1280x720.jpg')

# Circa 1.3 MB
#camera.resolution = (1920, 1080)
#camera.capture('1920x1080.jpg')

# Circa 1.4 MB
#camera.resolution = (2048, 1080)
#camera.capture('2048x1080.jpg')

# Circa 4.2 MB
#camera.resolution = (3280, 2464)
#camera.capture('3280x2464.jpg')
