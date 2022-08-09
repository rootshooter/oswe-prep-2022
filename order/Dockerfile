FROM debian:latest

RUN apt-get update && apt-get install sudo python3 python3-pip postgresql python3-dev libpq-dev -y
RUN pip3 install flask psycopg2

COPY ./.sql /app/.sql
COPY ./.docker /app/.docker
COPY ./app.py /app/app.py
COPY ./static /app/static/
COPY ./templates /app/templates/

EXPOSE 5000
ENTRYPOINT ["/bin/sh", "/app/.docker/entrypoint.sh"]