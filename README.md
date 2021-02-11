## Процесс установки

- git clone --recurse-submodules https://github.com/kllakk/library-app.git library-app
- cd library-app
- cp .env.example .env
- cp .env.laradock laradock/.env
- cd laradock
- docker-compose up -d nginx mysql phpmyadmin redis workspace
- docker exec laradock_workspace_1 composer install
- docker exec laradock_workspace_1 php artisan migrate
- docker exec laradock_workspace_1 php artisan db:seed
- docker exec laradock_workspace_1 php artisan test

## Web-сервер

- http://localhost:8087
