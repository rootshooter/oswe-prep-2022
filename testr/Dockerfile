FROM debian:latest

RUN apt-get update
RUN apt-get install python3 python3-pip firefox-esr cron -y

COPY ./.docker/geckodriver /usr/bin/

RUN pip3 install flask
RUN pip3 install 'selenium<4.0.0'

COPY ./ /app

COPY ./.docker/emulate_cron /etc/cron.d/emulate_admin
RUN chmod 0644 /etc/cron.d/emulate_admin &&\
    crontab /etc/cron.d/emulate_admin

EXPOSE 5000
ENTRYPOINT ["/bin/bash","/app/.docker/entrypoint.sh"]
