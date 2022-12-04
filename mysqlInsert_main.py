#!/usr/bin/python

# Copyright (c) 2014 Adafruit Industries
# Author: Tony DiCola
# Modified By : Setiyadi_Ben for Praktikum Algoritma dan Pemrograman II
# at Politeknik Negeri Semarang (Polines)

# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:

# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.
import Adafruit_DHT
import time

# Sensor should be set to Adafruit_DHT.DHT11,
# Adafruit_DHT.DHT22, or Adafruit_DHT.AM2302.
sensor = Adafruit_DHT.DHT11

# Example using a Raspberry Pi with DHT sensor
# connected to GPIO4.
pin = 4

import RPi.GPIO as GPIO
import time
 
#GPIO Mode (BOARD / BCM)
GPIO.setmode(GPIO.BCM)
 
#set GPIO Pins
GPIO_TRIGGER = 18
GPIO_ECHO = 24
 
#set GPIO direction (IN / OUT)
GPIO.setup(GPIO_TRIGGER, GPIO.OUT)
GPIO.setup(GPIO_ECHO, GPIO.IN)

import mysql.connector
mydb = mysql.connector.connect(
  host="localhost",
  user="admin",
  password="admin",
  database="latihan_db"
)
import datetime
now = datetime.datetime.now()
formatted_date = now.strftime('%Y-%m-%d %H:%M:%S')
mycursor = mydb.cursor()


def distance():
    # set Trigger to HIGH
    GPIO.output(GPIO_TRIGGER, True)
 
    # set Trigger after 0.01ms to LOW
    time.sleep(0.00001)
    GPIO.output(GPIO_TRIGGER, False)
 
    StartTime = time.time()
    StopTime = time.time()
 
    # save StartTime
    while GPIO.input(GPIO_ECHO) == 0:
        StartTime = time.time()
 
    # save time of arrival
    while GPIO.input(GPIO_ECHO) == 1:
        StopTime = time.time()
 
    # time difference between start and arrival
    TimeElapsed = StopTime - StartTime
    # multiply with the sonic speed (34300 cm/s)
    # and divide by 2, because there and back
    distance = (TimeElapsed * 34300) / 2
 
    return distance

if __name__ == "__main__":
    while True:
        humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
        print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(temperature, humidity))
        time.sleep(4)
        
        dist = distance()
        print ("Measured Distance = %.1f cm" % dist)
        time.sleep(4)
        
        sql = "INSERT INTO tabelSensor (datetime, hcsr, temp, humi) VALUES (%s, %s, %s, %s)"
        val = ((formatted_date), (dist), (temperature), (humidity))
        mycursor.execute(sql, val)
        
        mydb.commit()
        print(mycursor.rowcount, "was inserted.")
        # Looping
        time.sleep(5)