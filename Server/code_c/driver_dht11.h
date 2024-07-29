#ifndef DRIVER_DHT11_H_
#define DRIVER_DHT11_H_

//define pins of raspberry pi4
#define PB0 17
#define PB1 18 
#define PB2 22
#define PB3 23
#define PC1 24   
#define PC2 25   
#define PB6 26 
#define PB7 27

//define directions and values
#define LOW  0
#define HIGH 1
#define IN   0
#define OUT  1

//define intertupt levels
#define	INT_EDGE_SETUP		0
#define	INT_EDGE_FALLING	1
#define	INT_EDGE_RISING		2
#define	INT_EDGE_BOTH		3

//define true and false values
#ifndef	TRUE
#  define	TRUE	(1==1)
#  define	FALSE	(!TRUE)
#endif

struct driverNodeStruct {
    int pin;
    int direction;
    int value;
};
typedef struct driverNodeStruct driverNode;
void pinMode(int pin, int mode);
void digitalWrite(int pin , int value);
void delay(int time);
void delayMicroseconds(int time);
void read_dht11_dat(int pin);

#endif /* DRIVER_DHT11_H_ */