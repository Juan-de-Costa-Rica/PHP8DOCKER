FROM nginx:stable-alpine

COPY ./configs/nginx.conf.template /nginx.conf.template

CMD ["/bin/sh" , "-c" , "envsubst '$ROOT $HOST $LISTEN_443 $FULLCHAIN $PRIVKEY' < /nginx.conf.template > /etc/nginx/conf.d/default.conf && exec nginx -g 'daemon off;'"]

RUN mkdir -p /var/www/html
