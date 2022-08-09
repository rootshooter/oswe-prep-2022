FROM debian:latest

# copy files to /app
WORKDIR /app
COPY . /app

# install necessary packages
RUN apt-get update
RUN apt-get install -y nodejs npm wget gnupg
RUN wget -qO - https://www.mongodb.org/static/pgp/server-4.4.asc | apt-key add -
RUN echo "deb http://repo.mongodb.org/apt/debian buster/mongodb-org/4.4 main" | tee /etc/apt/sources.list.d/mongodb-org-4.4.list
RUN apt-get update
RUN apt-get install -y mongodb-org

# update npm
RUN npm install -g npm@latest

# install node modules
RUN npm install

# start the app
EXPOSE 3000
CMD ["/bin/sh",".docker/entrypoint.sh"]