#!/bin/bash

cd ./ # go to the root of the project


lando start # start the containers lando

lando composer install # install the dependencies

lando db-import ./appliAirbnb.sql # import the database

echo "Setup complete, don't forget to connect you to the database" # message to the user

