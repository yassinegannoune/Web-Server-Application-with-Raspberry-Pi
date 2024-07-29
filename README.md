# Project Design and Modeling: Web Server Application with Raspberry Pi

## Overview

This project focuses on developing a web server application using a Raspberry Pi. The goal is to create a versatile and scalable system capable of handling real-time data and providing intuitive user interfaces. Below is a detailed diagram of the project design and modeling.

![Présentation sans titre](https://github.com/user-attachments/assets/c2c5e25b-c0ca-4650-8e7e-0879f95f688d)

## Components and Technologies

1. **Web Server:**
   - **Lighttpd**: Lightweight web server used to serve the web page.
   - **Node.js**: JavaScript runtime for handling asynchronous events and server-side logic.
   - **PHP**: Scripting language for server-side logic and database interaction.

2. **Database:**
   - **SQLite3**: Lightweight database for storing historical data and other persistent information.

3. **Programming Languages:**
   - **Python**: Used for main application logic, including handling sensor data and controlling hardware components.
   - **C**: Used to build custom drivers for real-time purposes, particularly for temperature and humidity sensors.

4. **Hardware Components:**
   - **Raspberry Pi**: Central unit controlling all operations and interfacing with other hardware components.
   - **Temperature & Humidity Sensors**: Collects environmental data to be processed and displayed.
   - **LCD/LED Control**: Displays information and provides visual feedback.
   - **Motor Control**: Manages motor operations based on the application requirements.

5. **User Interface:**
   - **Web Page**: The main interface for users to interact with the system, implemented using AJAX for dynamic updates without full page reloads.

6. **Security and Permissions:**
   - **chmod 755**: Ensures proper permissions for executable scripts and directories.
   - **hostname -I**: Used to retrieve the IP address of the Raspberry Pi for network configuration.

7. **Networking:**
   - **SSH**: Secure Shell for remote access and management.
   - **WiFi**: Wireless connectivity for remote access and data transfer.

## Implementation

1. **Setup Web Server:**
   - Install and configure Lighttpd, Node.js, and PHP on the Raspberry Pi.
   - Ensure the web server is accessible via the Raspberry Pi’s IP address.

2. **Database Configuration:**
   - Set up SQLite3 to store sensor data and other relevant information.
   - Implement Python scripts to interact with the database.

3. **Sensor Integration:**
   - Develop C drivers for real-time sensor data acquisition.
   - Implement Python scripts to process and visualize sensor data.

4. **Hardware Control:**
   - Implement Python scripts for controlling LCD/LED displays and motors.
   - Ensure hardware components are responsive to user commands via the web interface.

5. **User Interface Development:**
   - Design an intuitive web page with AJAX for real-time updates.
   - Ensure the web page can display sensor data and control hardware components.

## Conclusion and Video Demo

This project demonstrates the potential of using Raspberry Pi for developing a versatile web server application. By addressing challenges such as resource management, security, and scalability, the project highlights the importance of rigorous design and adaptation to meet technical constraints and client needs. This experience has provided valuable insights and enhanced my expertise in web server application design and development.

https://github.com/user-attachments/assets/68dc873a-3f31-446f-980e-fb5ddef13477


