#include <stdio.h>
#include <stdlib.h>
#include<time.h>
#include <stdint.h>
#include "driver_dht11.h"
#define MAXTIMINGS	85
int dht11_dat[5] = { 0, 0, 0, 0, 0 };
 

void pinMode(int pin, int mode){
    driverNode *node = (driverNode *)malloc(sizeof(driverNode));
    node->pin = pin;
    node->direction = mode;

    FILE *p_gpio_line;
    
    /* Exporting GPIO line */
    if ((p_gpio_line = fopen("/sys/class/gpio/export", "w")) == NULL)
    {
        printf("Cannot open export file.\n");
        exit(1);
    }
    rewind(p_gpio_line);
    char buffer[4];
    sprintf(buffer, "%d", node->pin); //convert int to string
    node->pin = pin;
    fwrite(buffer, sizeof(char), 2, p_gpio_line); 
    fclose(p_gpio_line);

    //set direction
    FILE *p_gpio_direction;
    char gpio_direction[35];

    sprintf(gpio_direction, "/sys/class/gpio/gpio%d/direction",node->pin);

    if ((p_gpio_direction = fopen(gpio_direction, "w+")) == NULL)
    {
        printf("Cannot open direction file.\n");
        exit(1);
    }
    rewind(p_gpio_direction);
    if( mode==IN ) {
        fputc((int)'i', p_gpio_direction);
        fputc((int)'n', p_gpio_direction);
        node->direction = IN;
    }
    else{
        fputc((int)'o', p_gpio_direction);
        fputc((int)'u', p_gpio_direction);
        fputc((int)'t', p_gpio_direction);
        node->direction = OUT;
    }

    fclose(p_gpio_direction);
  

    return 0;
}
void delay(int ms){
    clock_t start_time = clock();
    while (clock() < start_time + ms);
}
void delayMicroseconds(int us){
    clock_t start_time = clock();
    while (clock() < start_time + us/1000);
}
void read_dht11_dat(int DHTPIN)
{
	uint8_t laststate	= HIGH;
	uint8_t counter		= 0;
	uint8_t j		= 0, i;
	float	f; 
 
	dht11_dat[0] = dht11_dat[1] = dht11_dat[2] = dht11_dat[3] = dht11_dat[4] = 0;
 
	pinMode( DHTPIN, OUT );
	digitalWrite( DHTPIN, LOW );
	delay( 18 );
	digitalWrite( DHTPIN, HIGH );
	delayMicroseconds( 40 );
	pinMode( DHTPIN, IN );
 
	for ( i = 0; i < MAXTIMINGS; i++ )
	{
        struct timespec tim, tim2;
		counter = 0;
		while ( digitalRead( DHTPIN ) == laststate )
		{
			counter++;
			delayMicroseconds( 1 );
			if ( counter == 255 )
			{
				break;
			}
		}
		laststate = digitalRead( DHTPIN );
 
		if ( counter == 255 )
			break;
		if ( (i >= 4) && (i % 2 == 0) )
		{
			dht11_dat[j / 8] <<= 1;
			if ( counter > 16 )  //to check if the bit is a 1 or a 0 ,if the counter is greater than 16 then the bit is a 1
				dht11_dat[j / 8] |= 1;
			j++;
		}
	}
 
	if ( (j >= 40) &&
	     (dht11_dat[4] == ( (dht11_dat[0] + dht11_dat[1] + dht11_dat[2] + dht11_dat[3]) & 0xFF) ) ) //we use 0xFF to mask the last 8 bits of the sum of the first 4 bytes
	{
		f = dht11_dat[2] * 9. / 5. + 32; //to convert the temperature from celsius to fahrenheit
		printf( "Humidity = %d.%d %% Temperature = %d.%d C (%.1f F)\n",
			dht11_dat[0], dht11_dat[1], dht11_dat[2], dht11_dat[3], f ); //print the humidity and temperature
	}else  {
		printf( "Data not good, skip\n" ); //if the data is not good then we skip it
	}
}