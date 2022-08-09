#!/bin/bash
sudo docker inspect --format '{{ .NetworkSettings.IPAddress }}' $(docker ps -q)
