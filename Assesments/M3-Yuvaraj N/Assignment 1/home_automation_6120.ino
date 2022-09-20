#include<Servo.h>
int us = 6;
int servo = 7;

Servo servo1;

void setup() {
  Serial.begin(9600);
  servo1.attach(servo);
  pinMode(2,INPUT);
  pinMode(4,OUTPUT);
  pinMode(11,OUTPUT);
  pinMode(12,OUTPUT);
  pinMode(13,OUTPUT);
  pinMode(A0,INPUT);
  digitalWrite(2,LOW);
  digitalWrite(11,HIGH);
  
}

void loop() {
  
  long duration, inches, cm;

  pinMode(us, OUTPUT);
  digitalWrite(us, LOW);
  delayMicroseconds(2);
  digitalWrite(us, HIGH);
  delayMicroseconds(5);
  digitalWrite(us, LOW);

  
  pinMode(us, INPUT);
  duration = pulseIn(us, HIGH);

 
  inches = microsecondsToInches(duration);
  cm = microsecondsToCentimeters(duration);

 
  
  servo1.write(0);
  
  if(cm < 30)
  {
    servo1.write(120);
    Serial.println("A Person Arrived, Door is Opening......");
    delay(2000);
  }
  else
  {
    servo1.write(0);
    Serial.println("Door is Closed.....");
  }
  
  
  int pir = digitalRead(2);
  
  if(pir == HIGH)
  {
    digitalWrite(4,HIGH);
    delay(3000);
  }
  else if(pir == LOW)
  {
    digitalWrite(4,LOW);
  }
  
  float value=analogRead(A0);
  float temp=(((value/1024)*5.0199)-0.5)*100;
  
  
  Serial.print("temp is ");
  Serial.println(temp);
  delay(3000);
  
  
  if(temp > 20)
  {
    digitalWrite(12,HIGH);
    digitalWrite(13,LOW);
  }
  else
  {
    digitalWrite(12,LOW);
    digitalWrite(13,LOW);
  }
}

long microsecondsToInches(long microseconds) {
  return microseconds / 74 / 2;
}

long microsecondsToCentimeters(long microseconds) {
  return microseconds / 29 / 2;
}
