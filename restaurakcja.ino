
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// common.h

// [todo]
// std::map<String, String>
// localization map
#include <map>

#include <SPI.h>
#include <Wire.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SH1106.h>

// I2C pins
#define OLED_SDA 21
#define OLED_SCL 22

#define MY_SSID "coco_net";
#define MY_PASSWD "coco_net";
#define MY_SRV "https://kacmal.pl/restaurakcja"
#define MY_AUTH_SRV "https://default:phplaravel@kacmal.pl/restaurakcja"

const char *ssid = MY_SSID;
const char *password = MY_PASSWD;
const char *server = MY_SRV;
const char *auth_server = MY_SRV;
const char *apiToken = "1|feMA4e2vT2ExRiFzw5aDoxYsicE1JGvly8dMTdWwa98ae84f";

int currentTaskId = -1;
String currentTaskBody = "";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// button.h
//

enum class Button : byte
{
  next = 2, // left button pin
  done = 4  // right button pin
};

void handleButtonPress(Button button);

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// helper.h

constexpr String requestDone(String server, int id)
{
	return server + "/api/task/" + String(id) + "/done";
}

constexpr String requestNext(String server)
{
	return server + "/api/task/next";
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// client.h
//

String markTaskDone(int id);
String requestNextTask();

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// oled.h
//

Adafruit_SH1106 OLED(OLED_SDA, OLED_SCL);

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// wifi.h
//

const String WIFI_CONNECTED = "Wifi: Polaczone.";
const String WIFI_FAILURE = "Wifi: Niepowodzenie.";



//*****************************************************************************

void setup()
{
  // 115 200 bps
  Serial.begin(115200);

  // display type, I2C address
  OLED.begin(SH1106_SWITCHCAPVCC, 0x3C);

  // font properties
  OLED.setTextSize(1);
  OLED.setTextColor(WHITE);

  // default: (0, 0): left-top corner
  // display.setCursor(x, y)
  OLED.setCursor(0, 0);
  // reset last print from previous program
  OLED.clearDisplay();
  OLED.print("\r\nConnecting...");
  OLED.display();

  // BUTTONS
  pinMode((byte)Button::next, INPUT);
  pinMode((byte)Button::done, INPUT);

  // WIFI
  WiFi.begin(ssid, password);

  //
  // track # of ms
  // since board booted (not program startd, BOARD BOOTED)
  //
  // https://docs.arduino.cc/language-reference/en/functions/time/millis/
  // This number will overflow (go back to zero), after approximately 50 days.
  // 4,294,967,296 / 1000 / 60 / 60 / 24 = 50 (days)
  unsigned int start = millis();
  
  while(WiFi.status() != WL_CONNECTED && millis() - start < 16000)
  {
    delay(250);
    Serial.print(".");
  }

  if (WiFi.status() == WL_CONNECTED)
  {
    Serial.print("\r\n" + WIFI_CONNECTED);

    OLED.clearDisplay();
    OLED.print("\r\n" + WIFI_CONNECTED);
    OLED.display();
  }
  else
  {
    Serial.print("\r\n" + WIFI_FAILURE);

    OLED.clearDisplay();
    OLED.print("\r\n" + WIFI_FAILURE);
    OLED.display();
    
  }
  
}

//*****************************************************************************

void loop()
{
  // wiring: reading before dissipating the Intensity
  bool isNextPressed = digitalRead((byte)Button::next) == HIGH;
  bool isDonePressed = digitalRead((byte)Button::done) == HIGH;

  if (isNextPressed)
  {
    handleButtonPress(Button::next, OLED);
  }
  else
  if (isDonePressed)
  {
    handleButtonPress(Button::done, OLED);
  }

  // debounce button
  // holding button is like spam clicking
  delay(100);

}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// button.cpp
//

//*****************************************************************************

void handleButtonPress(Button button, Adafruit_SH1106 & OLED)
{
  String message = "Aktywacja przycisku niedostepna.";

  if (button == Button::next)
  {
    message = requestNextTask();
  }
  else
  if (button == Button::done)
  {
    if (currentTaskId != -1)
    {
      message = markTaskDone(currentTaskId, OLED);  
    }
  }
  
  OLED.clearDisplay();

  // put cursor @ the beginning
  // cursor travels forward after each printing
  OLED.setCursor(0, 0);
  
  OLED.print("\r\n" + message);

  // render text
  OLED.display();
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// client.cpp
//

//*****************************************************************************

String markTaskDone(int id, Adafruit_SH1106 & OLED)
{
  String returnMessage = "";
  
  if (WiFi.status() != WL_CONNECTED)
  {
    return WIFI_FAILURE;
  }

  HTTPClient http;
  String url = requestDone(auth_server, id);
  http.begin(url);
	// Authorization: Bearer 12345678...
  http.addHeader("Authorization", String("Bearer ") + apiToken);
  http.addHeader("Content-Type", "application/json");

  // extra data to send with POST
  // format: "attr=value&attr_2=value_2"
  int code = http.POST("");

  if (code == 200)
  {
    String payload = http.getString();
    StaticJsonDocument<128> jsonObject;
    // StaticJsonDocument into, string from
    deserializeJson(jsonObject, payload);
    bool another = jsonObject["another"];

    returnMessage = another ? "Jest jeszcze jeden" : "Wszystkie zadania wykonane";

  }
  else
  {
    returnMessage = "HTTP error: " + String(code);
  }

  http.end();

  return returnMessage;
}

//*****************************************************************************

String requestNextTask()
{
  String returnMessage = "";
  
  if (WiFi.status() != WL_CONNECTED)
  {
    return WIFI_FAILURE;
  }

  HTTPClient http;
  String url = requestNext(server);
  http.begin(url);
  http.addHeader("Authorization", String("Bearer ") + apiToken);
  int code = http.GET();

  if (code == 200)
  {
    String payload = http.getString();

    // matching body size in: sqlite
    StaticJsonDocument<256> jsonObject;
    DeserializationError err = deserializeJson(jsonObject, payload);

    if ( ! err)
    {
      bool exists = jsonObject["exists"];
      if ( ! exists)
      {
        currentTaskId = -1;
        returnMessage = "Wszystko zrobione!";
      } 
      else
      {
        currentTaskId = jsonObject["id"];
        currentTaskBody = String((const char*)jsonObject["body"]);

        // C++11: string substr (size_t pos = 0, size_t len = npos) const;
        returnMessage = currentTaskBody.substring(0, 16);
        if (currentTaskBody.length() > 16)
        {
          returnMessage += "...";
        }
      } // if ! exists
    } // if ! err
  } // if code 200
  else
  {
    returnMessage = "HTTP error: " + String(code);
  }

  http.end();

  return returnMessage;
}
