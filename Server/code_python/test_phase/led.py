#!/usr/bin/env python3
import RPi.GPIO as GPIO
import time
LED_PIN = 17
LED_PIN2 = 18
def led_on():
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(LED_PIN, GPIO.OUT)
    GPIO.setup(LED_PIN2, GPIO.OUT)
    GPIO.output(LED_PIN2, GPIO.HIGH)
    GPIO.output(LED_PIN, GPIO.HIGH)
    return 0

def led_off():
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(LED_PIN, GPIO.OUT)
    GPIO.output(LED_PIN, GPIO.LOW)
    GPIO.setup(LED_PIN2, GPIO.OUT)
    GPIO.output(LED_PIN2, GPIO.LOW)
    return 1

def blink_led():
    cnt=0
    while cnt < 15:
        GPIO.output(LED_PIN, GPIO.HIGH)
        time.sleep(0.5)
        GPIO.output(LED_PIN, GPIO.LOW)
        time.sleep(0.5)
        cnt += 1
    return 2

