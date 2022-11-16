FROM nginx:latest
RUN apt-get update && apt-get upgrade -y vim

COPY ./src /usr/share/nginx/html



