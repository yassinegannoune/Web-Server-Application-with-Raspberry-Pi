#!/usr/bin/env python3
import RPi.GPIO as GPIO
import time
import sys


GPIO.setmode(GPIO.BCM)


led1_pin = 18
led2_pin = 17


GPIO.setup(led1_pin, GPIO.OUT, initial=GPIO.HIGH)
GPIO.setup(led2_pin, GPIO.OUT, initial=GPIO.HIGH)


pwm1 = GPIO.PWM(led1_pin, 800)
pwm2 = GPIO.PWM(led2_pin, 800)
pwm1.start(0)
pwm2.start(0)

try:

    frequency = float(sys.argv[1])

    while True:
        # Gradually increase the brightness of LED1 from 0% to 100%
        for duty_cycle in range(0, 101, 5):
            pwm1.ChangeDutyCycle(duty_cycle)
            time.sleep(0.1)

        # Gradually decrease the brightness of LED1 from 100% to 0%
        for duty_cycle in range(100, -1, -5):
            pwm1.ChangeDutyCycle(duty_cycle)
            time.sleep(0.1)

        # Gradually increase the brightness of LED2 from 0% to 100%
        for duty_cycle in range(0, 101, 5):
            pwm2.ChangeDutyCycle(duty_cycle)
            time.sleep(0.1)

        # Gradually decrease the brightness of LED2 from 100% to 0%
        for duty_cycle in range(100, -1, -5):
            pwm2.ChangeDutyCycle(duty_cycle)
            time.sleep(0.1)

        # Change the frequency of the PWM signals
        pwm1.ChangeFrequency(frequency)
        pwm2.ChangeFrequency(frequency)

except KeyboardInterrupt:
    pass

# Clean up the GPIO pins
pwm1.stop()
pwm2.stop()
GPIO.cleanup()
