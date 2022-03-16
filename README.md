
## Secret Lab

## Tech (lamp stack)
 - Laravel 8
 - PHP 7.3 and Above
 - MySQL
 - Apache

## Install
- clone the repo
- save as .env.example as .env
- update the required configuration for .env file
- ```cd``` to the project directory
- execute ```composer install```
- execute ```php artisan key:generate```
- execute ```php artisan migrate```

## Routing
 Store and update object - POST method
- /object 
```{ "keName": "value"}```

 Get object - GET method
 - /object/{keyName}

 Get object with timestamp - GET method
 - /object/{keyName}?timestamp={unixTimestamp}

 Get all records  - GET method
  - /object/get_all_records


## Unit test

 Use terminal and go to project directory
 Execute the below command
  ```php artisan test --testsuite=Feature```

## Reference

- **[Laravel](https://laravel.com/)**


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).


## Security Vulnerabilities

If you discover a security vulnerability then email to Subakaran via [subakaranmca@gmail.com](mailto:subakaranmca@gmail.com). 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
API is only allowed to use and modify by Author and SecretLab. Not allowed to use and modify by anyone.
