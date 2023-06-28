
## 🚀 First Clone

- **Project:** jsi
  > Use docker
- clone repository
- settings env
- download vendor ```
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs``` 
- ```sail up -d```
- buat key ``` sail artisan key:generate ```
- migrate database ``` sail artisan migrate ```
- import postman collection


- **Project:** jsi-frontend
  - ```npm i ```
  - ```npm run serve```

## Tech Stack

**Backend:** PHP, Laravel

**Frontend:** Vue

**Database:** Mysql


