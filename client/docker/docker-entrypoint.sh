#!/bin/bash

sed -i 's|${NGINX_HOST}|'"$NGINX_HOST"'|' /etc/nginx/conf.d/default.conf
sed -i 's|${NGINX_PORT}|'"$NGINX_PORT"'|' /etc/nginx/conf.d/default.conf
/etc/init.d/nginx restart
exec "$@"