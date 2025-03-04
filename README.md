
# Laravel API Demo


## Init
1. Install :  
```
composer install
```

2. 
```
cp .env.example .env
```

3.  
```
touch database/database.sqlite
```
edit .env :  
```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

```

then :  
```
php artisan key:generate
```

4.  
```
php artisan migrate
```

5.  
```
php artisan jwt:secret
```

**run** :  
```
php artisan migrate
```