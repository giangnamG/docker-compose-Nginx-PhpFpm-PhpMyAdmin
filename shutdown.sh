echo '' > log/access.log
echo '' > log/error.log
docker-compose down
docker image rm -f web_php-fpm web_nginx
docker images
