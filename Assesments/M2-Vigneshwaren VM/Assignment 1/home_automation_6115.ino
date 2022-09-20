// C++ code
//

int pir = A1;
int forceSensor = A2;
int buzzer = 9;

void setup()
{
  Serial.begin(9600);
  pinMode(pir, INPUT);
  pinMode(forceSensor, INPUT);
  pinMode(buzzer, OUTPUT);
}

void loop()
{
  if(isPressed() || isMoving())
  {
    digitalWrite(buzzer, HIGH);
    delay(5000);
  }
  digitalWrite(buzzer,LOW);
  delay(500);
}

bool isPressed()
{
  Serial.println("Pressing");
  if(analogRead(A2)>100)
    return(true);
  else
    return(false);
}

bool isMoving()
{
  Serial.println("Moving");
  if(analogRead(A1)>100)
    return(true);
  else
    return(false);
}
