

1. [ Potrzebne materiały ](#Potrzebne)
1. [ Widok złożenia ](#Widok)
1. [ Schemat połączeń ](#Schemat)
1. [ Instalacja środowiska Arduino IDE ](#Arduino)
1. [ Instalujemy sterownik komunikacyjny ](#ESP-WROOM-32)
1. [ Instalujemy inne sterowniki ](#biblioteki)
1. [ Wgrywanie szkicu do ESP8266 ](#Wgrywanie)

# Projekt wykonany na zaliczenie przedmiotu: Systemy Internetu Rzeczy.
> ***Projekt opiera się na technologiach OpenSource, na ich dokumentacjach. Linki do dokumentacji:***
> * https://laravel.com/docs/12.x
> * https://docs.arduino.cc/programming

<a name="Potrzebne"></a>
## Potrzebne materiały

* Mikrokontroler z modułem WiFi: ESP-WROOM-32
<img src="./README/esp_wroom_32.png" width="800">

* Płytka Stykowa 830 połączeń (mniej lub więcej: ok)
<img src="./README/breadboard.png" height="800">

* Wyświetlacz OLED o przekątnej 1.3" (inny wymiar: ok)
<img src="./README/oled.png" width="800">

* Przewody połączeniowe męsko-męskie (naręcze)
<img src="./README/przewody.png" width="800">

* Przyciski monostabilne (automatycznie odbijają po wciśnięciu) x2
<img src="./README/przyciski.png" width="800">

* Rezystory 10 kOhm x2
<img src="./README/resistor.png" width="800">

* Przewód komunikacyjny microUSB między Mikrokontrolerem ESP32 - komputerem
<img src="./README/usb.png" width="800">

<p>Elementy można kupuć razem w zestawie dla początkujących lub jako osobne produkty.<p>
<p>Polecana strona: <a href="https://botland.com.pl" target="_blank">https://botland.com.pl</a></p>

<a name="Widok"></a>
## Widok złożenia

![Widok](./README/zlozenie.jpg)

<a name="Schemat"></a>
## Schemat połączeń

![Schemat](./README/schemat.png)

<p>Połączenia na Twojej płytce stykowej (tej białej) mogą się różnić od przedstawionych na schemacie. To normalne i zależy od zakupionego sprzętu. Ważna jest jednak zgodność nazw pinów. W przypadku kontrolera znajdującego się z tyłu wyświetlacza OLED nazwy mogą się różnić, proszę zwrócić uwagę na kolejnośc podłączeń. Nazwy jednak nie powinny się różnić w przypadku Mikrokontrolera ESP32.</p>

![Schemat_flip](./README/schemat_flip.png)

<p>Proszę się przyjrzeć nazwom pinów na płytce ESP32 powiększając zdjęcie</p>

<a name="Arduino"></a>
## Instalacja środowiska Arduino IDE

<p align="justify">Pobieramy Arduino IDE w najnowszej wersji dla naszego systemu operacyjnego oraz instalujemy postępując zgodnie z kreatorem. <a href="https://www.arduino.cc/en/software" target="_blank">Link</a></p>

<h4>Dodatkowo należy zainstalować sterownik na porty USB naszego komputera</h4>

<p>01. Sterownik pobieramy ze strony <a href="https://www.silabs.com/software-and-tools/usb-to-uart-bridge-vcp-drivers?tab=downloads">silabs.com</a></p>

<p>02. Należy pobrać plik o nazwie: CP210x Universal Windows Driver lub podobnej jeśli wyszła nowsza wersja.</p>

<p>03. Teraz należy rozpakować plik.zip</p>

<p>04. W rozpakowanej strukturze znajdziemy instalator: silabser.inf</p>

<p>05. Klikamy na niego PPM -> Install. Proszę postępować zgodnie z instrukcjami kreatora.</p>

<a name="ESP-WROOM-32"></a>
## Instalujemy sterownik komunikacyjny między: ESP-WROOM-32 oraz naszym komputerem

<strong>Interfejs programu omawiany zostanie w języku angielskim</strong>

<p>01. Otwieramy zainstalowane w poprzednim kroku Arduino IDE</p>

<p>02. Klikamy w menu programu: File -> Preferences</p>

<p>03. Tutaj należy odszukać: Additional Boards Manager URLs</p>

<p>04. Obok powinno się znajdować Pole Tekstowe, należy wkleić:</p>

> ***https://dl.espressif.com/dl/package_esp32_index.json,https://raw.githubusercontent.com/espressif/arduino-esp32/gh-pages/package_esp32_index.json***

<img src="./README/ide_install_driver.jpg" width="800" />

<p>05. Potwierdzić okno dialogowe</p>
	
<p>06. Teraz przechodzimy w menu: Tools -> Board [...] -> Boards Manager</p>

<p>07. W pasku wyszukiwania wprowadzamy: "esp32"</p>

<p>08. Wybieramy najnowszą wersję oraz klikamy przycisk [Install] i postępujemy zgodnie z kreatorem</p>

<a name="biblioteki"></a>
## Instalujemy inne sterowniki (biblioteki) od osób trzecich

<p>01. Wchodzimy po kolei w linki poniżej</p>
<p>02. Należy odnaleźć przycisk do pobierania paczki.zip</p>
<p>(Na dzień: 18-12-2025) Klikamy zielony przycisk Code -> Download ZIP</p>
<p>Adafruit GFX: <a target="_blank" href="https://github.com/adafruit/Adafruit-GFX-Library">https://github.com/adafruit/Adafruit-GFX-Library</a></p>
<p>Adafruit Bus IO: <a target="_blank" href="https://github.com/adafruit/Adafruit_BusIO">https://github.com/adafruit/Adafruit_BusIO</a></p>
<p>ESP32 sh1106 OLED: <a target="_blank" href="https://github.com/nhatuan84/esp32-sh1106-oled">https://github.com/nhatuan84/esp32-sh1106-oled</a></p>
<p>03. Po pobraniu otwieramy Arduino IDE</p>
<p>04. Klikamy w menu: Sketch -> Include Library -> Add .ZIP Library</p>
<p>05. Teraz należy odszukać pobrane bibliotki na komputerze</p>
<p>06. Powtarzamy od kroku 04. dla każdej biblioteki</p>

<a name="Wgrywanie"></a>
## Wgrywanie szkicu do ESP32

<p>Przed wykorzystaniem Arduino IDE należy fizycznie podłączyć Mikrokontroler ESP32.</p>
<p>Wykorzystujemy przewód microUSB. Po podłączniu powinna zapalić się dioda LED (przykładowo: czerwona)</p>
<p><strong>Proszę nie dotykać elektroniki w celu uniknięcia zwarcia, chyba że odłączamy przewód.</strong></p>

### Ustawienie Arduino IDE ###

1. Model płytki z ESP32
Klikamy w menu: Tools -> Boards -> ESP32 Arduino -> ESP32 Dev Module
1. Port szeregowy komunikacyjny, z komputera do mikrokontrolera
Klikamy w menu: Tools -> Port -> COMX (gdzie X jest zależne od naszego komputera, u mnie: "COM3")

### Teraz należy przygotować plik z programem (tzw. szkic)

1. Szkic pobieramy na komputer, znajduje się na ___githubie ***restaurakcja.ino***___

2. Otwieramy plik przez menu: File -> Open, odszukujemy pobrany szkic

3. Należy odszukać w kodzie i zaktualizować podane niżej linijki

```C++
#define MY_SSID "[nazwa naszej sieci wifi]";
#define MY_PASSWD "[hasło naszej sieci wifi]";
#define MY_SRV "https://localhost/restaurakcja"
#define MY_AUTH_SRV "https://default:phplaravel@localhost/restaurakcja"

const char *ssid = MY_SSID;
const char *password = MY_PASSWD;
const char *server = MY_SRV;
const char *auth_server = MY_SRV;
const char *apiToken = "[to wypełniamy wygenerowanym TOKENEM DOSTĘPU]";
```

4. Klikamy przycisk Verify (teraz nastąpi kompilacja), proszę poczekać kilka-kilkanaście minut

<p>Przycisk Verify powinien znajdować się w Arduino IDE: pod menu, na wstążce</p>

### Wgrywamy program do mikrokontrolera

<p>Klikamy przycisk Upload: znajdujący się na wstążce</p>

<p>Niedługo powinniśmy napis: "Connecting..." na płytce ESP32 :)</p>