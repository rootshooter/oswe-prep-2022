<img src="./static/images/python.png" width="150" height="150" />

# Testr

## Metadata
- Author: William Moody
- Started: 22.03.2021

## Description
Testr is an invite-only web-based IDE for Python, created with the purpose of practicing web-app vulnerabilities. Specifically XSS and Code injecetion / Filter bypassing.

There is a cronjob which emualates admin actions every minute in the docker container.

## Set Up
1. Clone the repo locally `git clone https://github.com/bmdyy/testr`
2. Enter the folder `cd testr`
3. Build the docker container: `docker build -t testr .`
4. Run the container: `docker run -t testr`

## Solutions
Solutions and explanations may be found in `./exploit`
