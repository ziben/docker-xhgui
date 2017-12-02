FROM php:5-fpm-alpine

RUN sed -ri -e 's!http://dl-cdn.alpinelinux.org!https://mirrors.aliyun.com!g' /etc/apk/repositories

RUN apk update \
    && apk --no-cache add $PHPIZE_DEPS openssl-dev ca-certificates tzdata \
    && ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo "Asia/Shanghai" > /etc/timezone

COPY timezone.ini /usr/local/etc/php/conf.d/timezone.ini


RUN curl -fsSL 'https://github.com/tideways/php-profiler-extension/archive/v4.1.4.tar.gz' -o tideways.tar.gz \
    && mkdir -p /tmp/tideways \
    && tar -xf tideways.tar.gz -C /tmp/tideways --strip-components=1 \
    && rm tideways.tar.gz \
    && docker-php-ext-configure /tmp/tideways \
    && docker-php-ext-install /tmp/tideways \
    && rm -r /tmp/tideways \
    && pecl install mongodb-1.3.3 \
    && docker-php-ext-enable mongodb \
    && curl -fsSL 'https://github.com/perftools/xhgui/archive/master.zip' -o xhgui.tar.gz \
    && unzip xhgui.zip -d /tmp \
    && rm xhgui.zip \
    && mv /tmp/xhgui-master /var/www/html/xhgui \
    && cd /var/www/html/xhgui \
    && php install.php
     
COPY tideways.ini /usr/local/etc/php/conf.d/tideways.ini
