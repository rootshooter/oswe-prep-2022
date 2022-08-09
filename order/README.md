# Order

## Metadata

- William Moody
- 21.03.2021

## Description

A small app written in Python (Flask) and PostgreSQL to practice blind SQLi in the `ORDER BY` clause.

Comes with a dockerfile, so it is easy to set up locally to practice yourself.

A working exploit may be found in `/.exploit`

## How to set up locally

1. Clone the repo: `git clone https://github.com/bmdyy/order`
2. Enter the directory: `cd order`
3. Run `./start-docker.sh`
4. _Optional: Run `./get-ip-docker.sh` to find the container's IP_

The app is available at: `http://IP:5000/`
