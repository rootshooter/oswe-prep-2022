#!/bin/sh
docker kill $(docker ps|grep order|awk '{split($0,a," "); print a[1]}')
