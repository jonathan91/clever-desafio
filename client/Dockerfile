FROM nginx:1.13

WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    systemd \
    init \
    python3-systemd && rm -rf /var/lib/apt/lists/*

COPY ./ /app
COPY ./docker/docker-entrypoint.sh /sbin
RUN apt-get update -y
RUN apt-get install -y curl
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get update -y
RUN apt install -y nodejs
RUN npm install
RUN node --max_old_space_size=6144 ./node_modules/@angular/cli/bin/ng build --prod
RUN mv dist/ /usr/share/nginx/
RUN rm -rf /usr/share/nginx/html
RUN mv /usr/share/nginx/dist /usr/share/nginx/html
RUN chmod +x /usr/share/nginx/html
COPY ./docker/nginx_config/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx_config/proxy.conf /etc/nginx/proxy.conf
RUN chmod +x /sbin/docker-entrypoint.sh 
EXPOSE 80

ENTRYPOINT ["/sbin/docker-entrypoint.sh"]
CMD ["/sbin/init"]