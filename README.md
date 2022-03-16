
# TEST API
Descripcion del proyecto

## Descripción y contexto
Ej: API Backend. Swagger

## API Reference
- {url}/api/documentation
  
## Authors
- [@EsmerlinJM](https://www.github.com/EsmerlinJM)

## Deployment without Docker
- cp .env.example .env
- Configurate .env values: mysql, redis, etc...
- composer install
- php artisan key:generate
- php artisan migrate:refresh --seed
- php artisan l5:generate
- php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
- php artisan serve

## Deployment with Sail/Docker
- cp .env.example .env
- Configurate .env values: mysql, redis, etc...
- composer install
- php artisan key:generate
- php artisan migrate:refresh --seed
- php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
- alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
- sail up

## Swagger URL

- {url}/api/documentation

## Librerias y Requerimientos
- PHP ^8.0.2
- DarkaOnline: l5-swagger
- Laravel: FrameWork ^9.2

## Environment Variables

#### APP VARIABLES
- APP_NAME={APP_NAME}
- APP_ENV={local}|{dev}|{production}
- APP_KEY={base64Key}
- APP_DEBUG={true}|{false}
- APP_URL={API_URL}
- APP_PORT={API_PORT}


#### DATABASE CONNECTION
- DB_CONNECTION=mysql
- DB_HOST={DB_HOST}
- DB_PORT={DB_PORT}
- DB_DATABASE={DB_NAME}
- DB_USERNAME={DB_USERNAME}
- DB_PASSWORD={DB_PASSWORD}

#### EMAIL CONFIGURATION FOR SENDING NOTIFICATIONS
- MAIL_MAILER=smtp
- MAIL_HOST={SMTP_HOST}
- MAIL_PORT={SMTP_PORT}
- MAIL_USERNAME={SMTP_USER_NAME}
- MAIL_PASSWORD={SMTP_PASSWORD}
- MAIL_ENCRYPTION="TLS"
- MAIL_FROM_ADDRESS={FROM_EMAIL}
- MAIL_FROM_NAME="${APP_NAME}"

#### REDIS CONFIGURATION
-REDIS_HOST={REDIS_HOST}
-REDIS_PASSWORD=null
-REDIS_PORT=6379

  
## Tech Stack

**API** Laravel | Redis | Mysql | Docker
