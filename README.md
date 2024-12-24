### Setup Guide project olive

## Step 1: clone project

```
1. git clone https://github.com/ductien2k3/datn.git

2. cd ....
```

## Step 2: setup docker

- [Install docker](https://docs.docker.com/compose/install/)

```
1. cp .env.example .env

2. docker-compose build

3. docker-compose up -d
```

## Step 3: setup laravel

```
1. docker exec -it container_name bash   / docker-compose exec container_name bash

2. mkdir storage

3. cd storage/

4. mkdir -p framework/{sessions,views,cache} - neu khong co

5. composer install

6. php artisan key:generate

7. php artisan migrate

8. php artisan db:seed

9. chmod 777 -R storage/

```

## Step 5: When change config queue
    
```
1. docker-compose dowm
2. docker-compose build
3. docker-compose up -d

OR

1. supervisorctl restart all
```

## NOTE

```
1. When change config crontab
    - cron reload

```
  composer require pusher/pusher-php-server

## chạy pusher chạy 2 cmd 
php artisan queue:work