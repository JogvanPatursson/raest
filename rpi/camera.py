import time
import dbComm
from picamera import PiCamera
from datetime import datetime

# Camera object
camera = PiCamera()

# Function to take photo witch camera and record timestamp on database
def takePhoto():
    # Get current timestamp
    now = datetime.now()
    currentTime = now.strftime("%Y-%m-%d %H:%M:%S")
    currentTimeString = str(currentTime)
    extensionString = ".jpg"

    # Sets the resolution and names the photo to be the current timestamp
    camera.resolution = (400, 225)
    camera.capture(currentTimeString + extensionString)

    # Call function to save photo timestamp to database
    dbComm.addPhoto(currentTimeString)
