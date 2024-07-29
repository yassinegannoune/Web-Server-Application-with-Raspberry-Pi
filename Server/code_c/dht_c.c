#include <wiringPi.h>
#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#define MAXTIMINGS	85
#define DHTPIN		7
int dht11_dat[5] = { 0, 0, 0, 0, 0 };
void read_dht11_dat()
{
	uint8_t laststate	= HIGH;
	uint8_t counter		= 0;
	uint8_t j		= 0, i;
	float	f; 
	FILE* file=fopen("/home/pi/drivers/file.txt","a");
 	if(file==NULL){
           printf("failed to open the file\n");
           exit(1);
        }

	dht11_dat[0] = dht11_dat[1] = dht11_dat[2] = dht11_dat[3] = dht11_dat[4] = 0;
 
	pinMode( DHTPIN, OUTPUT );
	digitalWrite( DHTPIN, LOW );
	delay( 18 );
	digitalWrite( DHTPIN, HIGH );
	delayMicroseconds(40 );
	pinMode( DHTPIN, INPUT );
 
	for ( i = 0; i < MAXTIMINGS; i++ )
	{
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
		fprintf(file,"%d.%d,%d.%d\n",dht11_dat[2], dht11_dat[3],dht11_dat[0], dht11_dat[1]);
	}else  {
		printf( "Data not good, skip\n" ); //if the data is not good then we skip it
	}
}
 
int main( void )
{

	printf( "Raspberry Pi wiringPi DHT11 Temperature test program\n" );
 	int i=0;
	if ( wiringPiSetup() == -1 )
		exit( 1 );
	while (i<200 )
	{
		read_dht11_dat();
		delay( 1000 );
		i++;
	}
 
	return(0);
}