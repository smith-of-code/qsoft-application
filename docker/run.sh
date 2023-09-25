#!/bin/bash

if [ -n "$1" ]
then
env_file=".env.$1"
else
echo "./run.sh  no param from ( prod, stage  )"
exit
fi

if [ -e $env_file ]
then
source $env_file
else
echo "env file not found"
exit
fi


docker network create ${APP_NAME}_bridge --subnet=${DOCKER_NETWORK_SUBNET}
docker-compose --env-file=$env_file --project-name=${APP_NAME} up -d --build

docker exec ${APP_NAME}_fpm composer update
docker exec ${APP_NAME}_fpm cp ${env_file} ../.env
#docker exec ${APP_NAME}_fpm php artisan storage:link
#docker exec ${APP_NAME}_fpm php artisan key:generate
#docker exec ${APP_NAME}_fpm chmod -R 0777 storage
#docker exec ${APP_NAME}_fpm php artisan migrate
docker exec ${APP_NAME}_fpm npm i
docker exec ${APP_NAME}_fpm npm run prod
