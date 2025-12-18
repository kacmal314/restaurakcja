

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

<p>01. Wchodzimy w link</p>
<p>02. Należy odnaleźć przycisk do pobierania paczki.zip</p>
<p>(Na dzień: 18-12-2025) Klikamy zielony przycisk Code -> Download ZIP</p>
<p>Adafruit GFX: <a href="https://github.com/adafruit/Adafruit-GFX-Library">https://github.com/adafruit/Adafruit-GFX-Library</a></p>
<p>Adafruit Bus IO: <a href="https://github.com/adafruit/Adafruit_BusIO">https://github.com/adafruit/Adafruit_BusIO</a></p>
<p>ESP32 sh1106 OLED: <a href="https://github.com/nhatuan84/esp32-sh1106-oled">https://github.com/nhatuan84/esp32-sh1106-oled</a></p>















<a name="Wgrywanie"></a>
## Wgrywanie szkicu do ESP8266

### Sterowniki do konwerterów _USB <-> serial (port szeregowy)_
Układ ESP8266 (inne mikrokontrolery podobnie) Posiadają jedynie port szeregowy (RS232). Wgrywanie oprogramowania wymaga przykładowo takiego [specjalnego programatora](https://botland.com.pl/pl/programatory/4481-programatordebugger-stm8stm32-zgodny-z-st-linkv2-mini-waveshare-10053.html?search_query=programator&results=30). Płytki takie jak _NodeMCU_, czy _WemosD1 mini_ posiadają wbudowany konwerter portu szeregowego. Przważnie jest to układ CP210x (NodeMCU v1, v2, WemosD1 mini pro)  

![CP2102](/README.md.fld/image027.png) 
  

i CH340 (WemosD1 mini, NodeMCU v3).  
  
  
![CH340](/README.md.fld/image026.png)  

Przed podłączeniem płytki do komputera należy zainstalować sterowniki do tego układu.  
[Sterowniki do _CP210x_ i instrukcje jak je zainstalować można znaleźć tutaj](https://www.silabs.com/products/development-tools/software/usb-to-uart-bridge-vcp-drivers)  

[Sterowniki do _CH340_ i instrukcje jak je zainstalować można znaleźć tutaj](https://sparks.gogo.co.nz/ch340.html) 

>Uwaga *Tylko MacOS* po wgraniu sterownika należy go włączyć w **Preferencje systemowe > Ochrona i prywatność**. [Opis zamieszczono tutaj](https://github.com/adrianmihalko/ch340g-ch34g-ch34x-mac-os-x-driver.git)

### Przed wgraniem szkicu do mikrokontrolera (NodeMCU, WemosD1, i in.) należy ustawić w Arduino IDE *dwie ważne rzeczy*:
1. Model płytki z mikrokontrolerem
![openfile](/README.md.fld/image024.png) 
1. Port szeregowy do komunikacji ___komputer <-> płytka___
Przed podłączeniem płytki do komputera wybieramy *__Narzędzia > Port__*. W ten sposób możemy wykryć, na którym porcie pojawi się nasza płytka. 
![openfile](/README.md.fld/image022.png) 
Teraz podpinamy płytkę i ponownie wybieramy *__Narzędzia > Port__*
![openfile](/README.md.fld/image023.png) 

> UWAGA: W systemie Windows porty te będą widoczne inaczej jako **COM2, COM3** itd.
### Teraz możemy przystąpić do wgrywania szkicu, czyli piku _.ino_ do płytki 

1. Gotowy szkic należy pobrać z ___githuba___ **stacjaMeteo_bmp180.ino** lub **stacjaMeteo_bmp280.ino** 

1. Pobrany plik wgrywamy do katalogu **Dokumenty &gt; Arduino &gt; stacjaMeteo_bmp180** lub **Dokumenty &gt; Arduino &gt; stacjaMeteo_bmp280**
Otwieramy wybrany plik w Arduino IDE: ![openfile](/README.md.fld/image016.png) 

1. klikamy ![openfile2](/README.md.fld/image015.png) 

1. Zmieniamy ustawienia sieci Wi-Fi na własne
![openfile](/README.md.fld/image017.png)
```C++
// Zastąp danymi własnej sieci wi-fi
const char* ssid = "NAZWA_SIECI_WIFI";
const char* password = "HASŁO_SIECI_WIFI";
``` 
5. Sprawdzamy czy nie ma błędów w składni: ![openfile](/README.md.fld/image018.png) 

1. Jeśli wszystko poszło dobrze można wgrać program: ![openfile](/README.md.fld/image019.png) 

> Jeśli pojawiły się błędy kompilacji (z kroku 5), to najprawdopodobniej nie wszystkie wymagane biblioteki zostały zainstalowane. 
Należy się upewnić czy jakaś inna bibliotekanie nie powoduje konfliktów. Jeśli samodzielnie edytowałeś szkic to może pojawił się błąd składni. Sprawdź opis błędy (na czerwono) w czarnym okienku na dole Arduino IDE. Najczęściej zapominamy o *__„;”__* na końcu linii bądź polecenia.

<font color:red >POWODZENIA!!!</font>
