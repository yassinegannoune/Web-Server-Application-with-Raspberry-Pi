#!/usr/bin/env python3
import RPi.GPIO as GPIO
import threading
import time

LED1_PIN = 17
LED2_PIN = 18

# Initialize GPIO
GPIO.setmode(GPIO.BCM)
GPIO.setup(LED1_PIN, GPIO.OUT)
GPIO.setup(LED2_PIN, GPIO.OUT)

# Define LED blinking function
def blink_led(led_pin, frequency):
    while True:
        GPIO.output(led_pin, GPIO.HIGH)
        time.sleep(0.5 / frequency)
        GPIO.output(led_pin, GPIO.LOW)
        time.sleep(0.5 / frequency)


t1 = threading.Thread(target=blink_led, args=(LED1_PIN, 5)) # LED1 blinks at 5 Hz
t2 = threading.Thread(target=blink_led, args=(LED2_PIN, 10)) # LED2 blinks at 10 Hz


t1.start()
t2.start()


t1.join()
t2.join()


GPIO.cleanup()
