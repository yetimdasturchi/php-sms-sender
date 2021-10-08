import requests, serial, time
from time import sleep
from curses import ascii

apiurl = "https://192.168.0.101/gsm/"
apitoken = "5985f57d8e6a80b8240b4b050e5a0d0d"

ser = serial.Serial()
ser.port = '/dev/ttyUSB0'

ser.baudrate = 115200
ser.timeout = 1
ser.open()
ser.write(str.encode('AT+CMGF=1\r\n'))
ser.write(str.encode('AT+CPMS="ME","SM","ME"\r\n'))

def sendsms(smsdata):
    ser.write(str.encode('AT+CMGF=1\r\n'))
    sleep(2)
    ser.write(str.encode('AT+CMGS="%s"\r\n' % smsdata['phone']))
    sleep(2)
    ser.write(str.encode('%s' % smsdata['message']))
    sleep(2)
    ser.write(str.encode(ascii.ctrl('z')))
    try:
    	return setMessageSended(smsdata['id'])
    except:
    	return setMessageSended(smsdata['id'])
    

def setMessageSended(smsid):
	sended = requests.get(url = apiurl+'sended', params = {"token": apitoken, 'smsid': smsid}, timeout=2)
	if sended.status_code == 200:
		return True
	else:
		return False

def getMessage():
	r = requests.get(url = apiurl+'unsended', params = {"token": apitoken}, timeout=2)
	if r.status_code == 200:
		return r.json()
	else:
		return False

while True:
	try:
		sms = getMessage()
		if sms['status'] == 'ok':
			sendsms(sms['data'])
			sleep(5)
		else:
			sleep(2)
	except:
		sleep(2)
