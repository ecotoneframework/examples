# Ecotone Examples

# How to run test scenario

Install dependencies using `composer install`

In each of the catalogs you will find run_example.php.
Simple run it using `php run_example.php`  

Some examples may require Database or RabbitMQ setup. You may run all examples from docker, so you do not need to setup anything.

    docker-compose up -d
    docker exec -it ecotone_example /bin/bash
    cd Modelling/Service
    php run_example.php

# How to interpret scenario

Examples in this repository are building using *Lite Ecotone*.  
If you're using Symfony or Laravel you will be interested only what is below: 

    // Begin test scenario

Before that there is a setup required to be done, because of lack of auto-wiring.  
After that you will mostly see, usage of some type of Gateway:  

    /** @var CommandBus $commandBus */
    $commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
    /** @var QueryBus $queryBus */
    $queryBus = $messagingSystem->getGatewayByName(QueryBus::class);
    
All gateways are available within Depedency Container in Laravel or Symfony for auto wire.  
So you may use them in your Controllers, Commands or whenever you want to begin the flow.


 
