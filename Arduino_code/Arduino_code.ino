#include <SoftwareSerial.h>
SoftwareSerial s(A4,A5);//RX a4, tx A5
#include <DHT.h>
#include <DHT_U.h>
uint8_t valoareUSA;
uint8_t temperatura;
uint8_t umiditate;
#define DHTPIN 2
#define DHTTYPE DHT22
#define USAPIN 3
DHT dht(DHTPIN, DHTTYPE);

int x=1;
unsigned long start;
unsigned long current;
const unsigned long period=10000;

void setup(){
  s.begin(115200);
  pinMode(USAPIN, INPUT_PULLUP);// rezistenta la VCC pt senzorul magnetic de usa
  Serial.begin(115200);
  start=millis();
  dht.begin();
}

void loop(){
  temperatura=dht.readTemperature();
  umiditate=dht.readHumidity();
  valoareUSA=digitalRead(USAPIN);
  unsigned long current=millis();
  if(current - start >= period){
  s.write(temperatura);
  s.write(umiditate);
  s.write(valoareUSA);
  Serial.println(temperatura);
  Serial.println(umiditate);
  Serial.println(valoareUSA);
  start=current;
}
}
