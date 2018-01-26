FROM composer

ENV DEBIAN_FRONTEND noninteractive

COPY . /code/
WORKDIR /code/
RUN composer install
CMD ["php", "/code/main.php"]
