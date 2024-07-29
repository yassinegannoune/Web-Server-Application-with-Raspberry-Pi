#!/usr/bin/env python3
import RPi.GPIO as GPIO
import time
SERVO_PIN = 18
GPIO.setmode(GPIO.BCM)
GPIO.setup(SERVO_PIN, GPIO.OUT)
pwm = GPIO.PWM(SERVO_PIN, 50)
pwm.start(0)

def set_servo_position(angle):
    if angle < 0 or angle > 180:
        raise ValueError("Angle must be between 0 and 180 degrees")
    duty_cycle = 2.5 + angle / 18.0
    pwm.ChangeDutyCycle(duty_cycle)
    return duty_cycle
# stop the PWM and clean up the GPIO resources
def cleanup():
    pwm.stop()
    GPIO.cleanup()
pwm.stop()
