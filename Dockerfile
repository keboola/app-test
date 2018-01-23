FROM php:7-cli

ENV DEBIAN_FRONTEND noninteractive

COPY . /code/
WORKDIR /code/
CMD ["php", "/code/main.php"]
