#!/usr/bin/env python3
import matplotlib.pyplot as plt


temperature = []
humidity = []

# Read data from file
with open('data.txt', 'r') as file:
    for line in file:
        hum,temp = line.strip().split(',')
        temperature.append(float(temp))
        humidity.append(float(hum))
print(humidity)
time = [i for i in range(len(temperature))]

plt.plot(time, temperature, label='Temperature (C)')
plt.plot(time, humidity, label='Humidity (%)')

plt.xlabel('Time (s)')
plt.ylabel('Temperature (C) / Humidity (%)')
plt.legend()

# Show the plot
#plt.show()
#save the plot as a png file
plt.savefig('plot_temp_humid.png')
