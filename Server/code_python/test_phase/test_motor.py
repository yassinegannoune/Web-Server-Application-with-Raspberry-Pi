#!/usr/bin/env python3
import pytest
from motor import set_servo_position
import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BCM)
GPIO.setup(18, GPIO.OUT)
pwm = GPIO.PWM(18,150)
pwm.start(0)
def test_set_servo_position():
    ds= set_servo_position(0)
    time.sleep(1)
    assert abs(ds - 2.5) < 0.1
    ds2=set_servo_position(90)
    time.sleep(1)
    assert abs(ds2 - 7.5) < 0.1
    ds3=set_servo_position(180)
    time.sleep(1)
    assert abs(ds3 - 12.5) < 0.1
