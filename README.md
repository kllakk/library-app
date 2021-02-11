## Процесс установки

- git clone --recurse-submodules https://github.com/kllakk/library-app.git library-app
- cd library-app
- cp .env.example .env
- cp .env.laradock laradock/.env
- cd laradock
- docker-compose up -d nginx mysql phpmyadmin redis workspace
- docker exec laradock_workspace_1 composer install

## Web-сервер

- http://localhost:8087
