#include <LiquidCrystal.h>
LiquidCrystal lcd(2, 3, 4, 5, 6, 7);

#define echoPin 8 //echo pin
#define trigPin 9 //Trigger pin

#define led1 A0 //red    led 1
#define led2 A1 //red    led 2
#define led3 A2 //yellow led 3
#define led4 A3 //yellow led 4
#define led5 A4 //green  led 5
#define led6 A5 //green  led 6

float time;
float waterlevel_cm;
float waterlevel_in;
 
void setup(){
// put your setup code here, to run once:
Serial.begin(9600);
pinMode(trigPin, OUTPUT);
pinMode(echoPin, INPUT);

pinMode(led1, OUTPUT);
pinMode(led2, OUTPUT);
pinMode(led3, OUTPUT);
pinMode(led4, OUTPUT);
pinMode(led5, OUTPUT);
pinMode(led6, OUTPUT);

lcd.begin(16, 2);
  lcd.setCursor(0,0);
  lcd.print(" Welcome To  My ");
  lcd.setCursor(0,1);
  lcd.print("project ");
delay(1000);
lcd.clear();
}
void loop(){

digitalWrite(trigPin, LOW); //PULSE ___|---|___
delayMicroseconds(2);
digitalWrite(trigPin, HIGH);
delayMicroseconds(10);

time = pulseIn(echoPin, HIGH);

waterlevel_cm = (time/2) / 29.1; // waterlevel for centimeter
waterlevel_in = (time/2) / 73.914; // waterlevel for inch

lcd.setCursor(0, 0);
lcd.print("    waterlevel   ");

lcd.setCursor(0, 1);
lcd.print(waterlevel_cm,1);
lcd.print("cm  ");

lcd.setCursor(9, 1);
lcd.print(waterlevel_in);
lcd.print("in  ");

Serial.print("cm= ");
Serial.print(waterlevel_cm);
Serial.print(" inch= ");
Serial.println(waterlevel_in);
 

if(waterlevel_cm<10){digitalWrite(led6, HIGH);}
else{digitalWrite(led6, LOW);}

if(waterlevel_cm<9){digitalWrite(led5, HIGH);}
else{digitalWrite(led5, LOW);}

if(waterlevel_cm<8){digitalWrite(led4, HIGH);}
if(waterlevel_cm<8){digitalWrite(led5, LOW);}
else{digitalWrite(led4, LOW);}

if(waterlevel_cm<7){digitalWrite(led3, HIGH);}
if(waterlevel_cm<7){digitalWrite(led4, LOW);}
else{digitalWrite(led3, LOW);}

if(waterlevel_cm<6){digitalWrite(led2, HIGH);}
if(waterlevel_cm<6){digitalWrite(led3, LOW);}
else{digitalWrite(led2, LOW);}

if(waterlevel_cm<5){digitalWrite(led1, HIGH);}
if(waterlevel_cm<5){digitalWrite(led2, LOW);}
else{digitalWrite(led1, LOW);}

if(waterlevel_cm<4){digitalWrite(led6,LOW);} //turn off LED
if(waterlevel_cm<4){digitalWrite(led5,LOW);} //turn off LED
if(waterlevel_cm<4){digitalWrite(led4,LOW);} //turn off LED
if(waterlevel_cm<4){digitalWrite(led3,LOW);} //turn off LED
if(waterlevel_cm<4){digitalWrite(led1,LOW);} //turn off LED
if(waterlevel_cm<4){digitalWrite(led2,LOW);} //turn off LED

delay(200);
}
