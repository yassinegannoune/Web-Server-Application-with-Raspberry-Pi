#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<unistd.h>
#include<time.h>
#include "driver_dht11.h"

int main(){
    printf("Reading from DHT11\n");
    while (1)
    {
        read_dht11_dat(7);
        delay(1000);
    }
    
}