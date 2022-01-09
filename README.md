## Installation Guide

1. Clone the repository using ``git clone https://github.com/enochval/clafiya-test.git``


2. Run composer install using ``composer install``


3. Setup database configuration

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

4. Run ``php artisan migrate``


5. Run ``php artisan passport:keys``


6. Run ``php artisan passport:client --personal``


## Available APIs

### Server BaseUrl [https://clafiya.nosvet.xyz](https://clafiya.nosvet.xyz)

- ``/api/register - POST``

Headers:

```
{
    "Accept": "application/json"
}
```

Schema:
```
{
    "first_name": "Clafiya",
    "last_name": "Healthcare",
    "email": "hi@clafiya.com",
    "phone_number": "09012345678",
    "password": "password123",
    "password_confirmation": "password123"
}
```


- ``/api/login - POST``

Headers:

```
{
    "Accept": "application/json"
}
```

Schema:
```
{
    "email": "hi@clafiya.com", // email or phone number works!
    "password": "password123"
}
```


- ``/api/logout - POST``

Headers:

```
{
    "Accept": "application/json",
    "Authorization": "Bearer <token>"
}
```




- ``/api/user - GET``

Headers:

```
{
    "Accept": "application/json",
    "Authorization": "Bearer <token>"
}
```



