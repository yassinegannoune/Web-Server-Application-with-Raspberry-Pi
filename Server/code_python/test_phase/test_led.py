#!/usr/bin/env python3
from led import led_on, led_off, blink_led
import RPi.GPIO as GPIO
#set up GPIOS and cleanup after test
def setup():
    GPIO.setmode(GPIO.BCM)
    yield
    GPIO.cleanup()

#test led_on,
def test_led_on():
    assert led_on() == 0
    assert GPIO.input(17) == GPIO.HIGH
    assert GPIO.input(18) == GPIO.HIGH
#test led_off
def test_led_off():
    assert led_off() == 1
    assert GPIO.input(17) == GPIO.LOW
    assert GPIO.input(18) == GPIO.LOW
#test blink_led
def test_blink_led():
    assert blink_led() == 2
    
