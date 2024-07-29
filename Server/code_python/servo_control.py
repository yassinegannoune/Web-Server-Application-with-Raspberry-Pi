#!/usr/bin/env python3
import RPi.GPIO as GPIO
import time

# Define GPIO pin for the servo motor
SERVO_PIN = 18

# Initialize GPIO
GPIO.setmode(GPIO.BCM)
GPIO.setup(SERVO_PIN, GPIO.OUT)

# Create PWM object with frequency of 50 Hz
pwm = GPIO.PWM(SERVO_PIN, 50)
pwm.start(0)


def set_servo_position(duty_cycle):
    pwm.ChangeDutyCycle(duty_cycle)

try:
    while True:
        set_servo_position(0)
        time.sleep(0.5)
        set_servo_position(4.5)
        time.sleep(0.5)
        set_servo_position(7.5)
        time.sleep(0.5)
        set_servo_position(10)
        time.sleep(0.5)
        set_servo_position(12.5)
        time.sleep(0.5)
        
except KeyboardInterrupt:
    pass

# Stop PWM and clean up GPIO
pwm.stop()
GPIO.cleanup()
