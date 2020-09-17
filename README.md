
# Laravel Health Check  
  
Package for checking the availability of project components 
  
## Laravel 5.5+
  
Install the ```saritasa/laravel-healthcheck``` package:  
  
```bash  
$ composer require saritasa/laravel-healthcheck  
```  

## Configuration
- Publish configuration file:

```bash
php artisan vendor:publish --tag=health_check
```

Configure the necessary checks

```php
    'checkers' => [
        'database' => \Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker::class,
        'redis' => \Saritasa\LaravelHealthCheck\Checkers\RedisHealthChecker::class,
        's3' => \Saritasa\LaravelHealthCheck\Checkers\S3HealthChecker::class,
    ],
```  

## Contributing  
  
1. Create fork, checkout it  
2. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)** -  
    run [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to ensure, that code follows style guides  
3. **Cover added functionality with unit tests** and run [PHPUnit](https://phpunit.de/) to make sure, that all tests pass  
4. Update [README.md](README.md) to describe new or changed functionality  
5. Add changes description to [CHANGES.md](CHANGES.md) file. Use [Semantic Versioning](https://semver.org/) convention to determine next version number.  
6. When ready, create pull request  
