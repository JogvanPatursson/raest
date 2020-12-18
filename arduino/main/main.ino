// Main Arduino Code

// Libraries

// Libraries for RFID reader
#include <SPI.h>
#include <MFRC522.h>

// Library for DHT11 temperature and humidity sensor
#include <DHT.h>

// Library for motion sensor

// Variables

// Test variable

int uidLength;

// Climate sensor variables
const int DHT_PIN = 2;
const int DHTTYPE = 11;

int temp;
int humid;

// RFID reader sensor
const int SS_PIN = 10;
const int RST_PIN = 9;

// Motion sensor variables
const int MOTION_PIN = 3;
int MOTION_STATE = 0;
String content= "";

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
  
  
  // Read temperature as Celsius
  float t = dht.readTemperature();

  // Printing temperature
  Serial.print("t: ");
  Serial.print(t);
  Serial.println();

  // Read humidity
  float h = dht.readHumidity();

  // Printing humidity
  Serial.print("h: ");
  Serial.print(h);
  Serial.println();

  // Data from motion sensor
  MOTION_STATE = digitalRead(MOTION_PIN);

  // Printing motion data
  Serial.print("Motion: ");
  Serial.print(MOTION_STATE);
  Serial.println();

  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }

  Serial.print("RFID: ");

  // Print out RFID
  for (byte i = 0; i < mfrc522.uid.size; i++)
  {
     Serial.print(mfrc522.uid.uidByte[i], HEX);
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  Serial.println();
}
