import time
import sys
import ibmiotf.application
import ibmiotf.device
import random
#Provide your IBM Watson Device Credentials
organization = "dm86e1"
deviceType = "raspberrypi"
deviceId = "demo333"
authMethod = "token"
authToken = "12345678"
# Initialize GPIO
 
 #print(cmd)
 
try:
deviceOptions = {"org": organization, "type": deviceType, "id": deviceId, "auth￾method": authMethod, "auth-token": authToken}
deviceCli = ibmiotf.device.Client(deviceOptions)
#..............................................
except Exception as e:
print("Caught exception connecting device: %s" % str(e))
sys.exit()
# Connect and send a datapoint "hello" with value "world" into the cloud as an event of type 
"greeting" 10 times
deviceCli.connect()
while True:
 #Get Sensor Data from DHT11
 
 speed=random.randint(50,100);
 
 data = { 'speed' : speed }
 #print data
 def myOnPublishCallback():
 print ("Published Driver Speed = %s km" % speed, "to IBM Watson")
 success = deviceCli.publishEvent("IoTSensor", "json", data, qos=0, 
on_publish=myOnPublishCallback)
 if not success:
 print("Not connected to IoTF")
 time.sleep(5)
 
 deviceCli.commandCallback = 'myCommandCallback'
# Disconnect the device and application from the cloud
deviceCli.disconnect()
