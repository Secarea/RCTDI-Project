#include<SoftwareSerial.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
const char* ssid = "DIGI-02335221";
const char* password = "Mye3Piyp";
const char* host= "192.168.1.6";
int ledPin = 2;
WiFiServer server(80);
WiFiClient client;

SoftwareSerial s(D6, D7);//recv D0, tx D1
uint8_t temperatura;
uint8_t umiditate;
uint8_t valoareUSA;
void setup() {
 Serial.begin(115200); 
 s.begin(115200);
 pinMode(ledPin, OUTPUT);
 digitalWrite(ledPin, HIGH);

 Serial.print("Connecting to ");
 Serial.println(ssid);

 WiFi.begin(ssid, password);

 while (WiFi.status() != WL_CONNECTED) {
 delay(500);
 Serial.print(".");
 }
 Serial.println("");
 Serial.println("WiFi connected");

// Start the server
 server.begin();
 Serial.println("Server started");

// Print the IP address
 Serial.print("Use this URL to connect: ");
 Serial.print("http://");
 Serial.print(WiFi.localIP());
 Serial.println("/");
}
void loop() {


// Check if a client has connected
 WiFiClient client = server.available();
 if (!client) {
 return;
 }

const int httpPort=80;


while(s.available()>0 && temperatura != 255 && umiditate !=255 && valoareUSA != 255){
if(client.connect(host, httpPort)){
temperatura=s.read();
umiditate=s.read();
valoareUSA=s.read();
Serial.println(temperatura);
Serial.println(umiditate);
Serial.println(valoareUSA);

client.print(String("GET http://192.168.1.6/ProiectwithVS/get.php?")+
                    ("&temperature=") + temperatura +
                    ("&humidity=") + umiditate +
                    ("&door=") + valoareUSA +
                    " HTTP/1.1\r\n" +
                    "Host: " + host + "\r\n" +
                    "Connection: close\r\n\r\n");


while(client.connected() || client.available())
{
  if(client.available())
  {
    String line= client.readStringUntil('\r');
    Serial.print(line);
  }
}
client.stop();
Serial.println("closing connection");
}else{
  Serial.println("connection failed");
  client.stop();
}
}
}
