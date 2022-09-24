import random
while True:

    a=random.randint(1,99)
    b=random.randint(1,99)
    if(a>34 and b>40):
        print("high temperature and humidity of:",a,b,"%","alarm is on")
    elif(a<34 and b<40):
        print("Low temperature and humidity of:",a,b,"%","alarm is off")
        
        break
        
