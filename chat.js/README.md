<img src="./public/assets/chat.svg" width="150" height="150" />

# Chat.JS (Vulnerable NodeJS Web-App)

## Metadata

- William Moody
- 21.03.2021

## Description

A small web app writen in Node.JS to practice NoSQLi and deserialization exploits.

Working exploits as well as explainations may be found in `./exploit`

## How to run locally

1. Clone this repo: `git clone https://github.com/bmdyy/chat.js`
2. Enter folder: `cd chat.js`
3. Run: `docker build -t chatjs .`
4. Run: `docker run -t chatjs`

To find the docker container's IP:
1. Run: `docker inspect --format '{{ .NetworkSettings.IPAddress }}' $(docker ps -q)`

To kill docker:
1. Run: `docker ps` and copy the id
2. Run: `docker kill <id>`

The app is running on `http://IP:3000`