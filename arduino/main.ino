// Main Arduino Code

// Libraries

// Libraries for RFID reader
#include <SPI.h>
#include <MFRC522.h>

// Library for DHT11 temperature and humidity sensor
#include <DHT.h>

// Library for motion sensor

// Variables

// Climate sensor variables
const int DHT_PIN = 2;
const int DHTTYPE = 11;

int temp;
int humid;

// RFID reader sensor
const int SS_PIN = 10;
const int RST_PIN = 9;

// Motion sensor variable
const int MOTION_PIN = 3;
int MOTION_STATE = 0;

// Char string for 
unsigned char rfid[8];

// Objects

DHT dht(DHT_PIN, DHTTYPE);
MFRC522 mfrc522(SS_PIN, RST_PIN);

void setup() {
  //Setting up serial connection and setting baud rate
  Serial.begin(9600);

  // Setup for temperature and humidity sensor
  dht.begin();
  
  // Setup from motion sensor
  pinMode (MOTION_PIN, INPUT);
  
  // Setup for RFID reader
  SPI.begin();
  mfrc522.PCD_Init();
  

}

void loop() {
  // Data from temperature and humidity sensor
    // Wait a few seconds between measurements.
  delay(1000);

  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius
  float t = dht.readTemperature();
  
  // Check if any reads failed and exit early (to try again).
  if (isnan(h)){
    
  }

  if (isnan(t)){
    
  }

  // Data from motion sensor
  MOTION_STATE = digitalRead(MOTION_PIN);

  if (MOTION_STATE == 1)
  {
    //
    
  }

  // Set rfid array to null
  //for (byte i = 0; i < mfrc522.uid.size; ++i)
  //{
  //  rfid[i] = byte();
  //}
  
  // Data from RFID reader
  if (mfrc522.PICC_IsNewCardPresent())
  {

    if(mfrc522.PICC_ReadCardSerial())
    {
      for (byte i = 0; i < mfrc522.uid.size; ++i)
      {
        rfid[i] = mfrc522.uid.uidByte[i];
        //Serial.print(mfrc522.uid.uidByte[i], HEX);
        //Serial.print(" ");
      }
      //Serial.println();
    }
  }

  // Printing through serial

  // Printing RFID data
  Serial.print("RFID: ");
  for (byte i = 0; i < mfrc522.uid.size; ++i)
  {
   Serial.print(mfrc522.uid.uidByte[i], HEX);
  }

  // 
  
  Serial.println();

  // Printing climate data
  Serial.print("t: ");
  Serial.print(t);
  Serial.println();
  Serial.print("h: ");
  Serial.print(h);
  Serial.println();
  
  // Printing motion data
  Serial.print("Motion: ");
  Serial.print(MOTION_STATE);
  Serial.println();
}
