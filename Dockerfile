FROM php:7.4-alpine

WORKDIR /app

COPY . .

ENV ORIGIN=""
ENV DESTINY=""
ENV TIME=0
ENV PLAN=0

CMD [ "sh", "-c", "php index.php $ORIGIN $DESTINY $TIME $PLAN " ]