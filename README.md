# rest-romans

The Most Unuseful Web Service to Convert Roman Numerals to Arabic and Vice Versa

## Description

This project provides a RESTful service to convert Roman numerals to Arabic and
Arabic numerals to Roman. Simple as it is. Also, it is written using PHP and
[Romans](https://github.com/wandersonwhcr/romans) library.

## Installation

You can build this service from source, but there is a Docker image ready to
use. That image is based on PHP-FPM and you must use a HTTP service as sidecar,
like NGINX.

```sh
cat > default.conf.template <<'EOF'
server {
    listen 80;

    root /var/www/html/public;
    index index.php;
    try_files $uri $uri/ /index.php;

    location ~* \.php$ {
        fastcgi_pass romans:9000;

        include fastcgi_params;

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param SCRIPT_NAME     $fastcgi_script_name;
    }
}
EOF

docker network create romans

docker run \
    --detach \
    --name romans \
    --network romans \
    --publish 9000 \
    wandersonwhcr/romans

docker run \
    --detach \
    --name romans-http \
    --network romans \
    --publish 80:80 \
    --volume "`pwd`/default.conf.template:/etc/nginx/templates/default.conf.template" \
    nginx
```

## Usage

As a RESTful service, it makes available two endpoints for convertions. Next
example uses `curl` to send a request to convert `1999` from Arabic numeral to
Roman.

```sh
curl http://localhost/v1/arabics/1999 \
    --include \
    --request GET \
    --header 'Accept: application/json'
```

```
HTTP/1.1 200 OK
Content-Type: application/json

{"arabic":"1999","roman":"MCMXCIX"}
```

There is another endpoint to convert from Roman numeral to Arabic as next
example.

```sh
curl http://localhost/v1/romans/MCMXCIX \
    --include \
    --request GET \
    --header 'Accept: application/json'
```

```
HTTP/1.1 200 OK
Content-Type: application/json

{"arabic":"1999","roman":"MCMXCIX"}
```

## Development

You can use Docker Compose to build images from this project and run a container
to develop and test this package.

```bash
docker-compose build
docker-compose run php-fpm composer install
docker-compose run php-fpm composer test
```
