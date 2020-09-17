
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
php artisan vendor:publish --provider="Saritasa\LaravelHealthCheck\HealthCheckServiceProvider"
```

Configure the necessary checks in file `config/health_check.php`

```php
    'checkers' => [
        'database' => \Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker::class,
        'redis' => \Saritasa\LaravelHealthCheck\Checkers\RedisHealthChecker::class,
        's3' => \Saritasa\LaravelHealthCheck\Checkers\S3HealthChecker::class,
    ],
```  

You can add more custom checks - a class implementing 
`\Saritasa\LaravelHealthCheck\Contracts\ServiceHealthChecker::class` interface with single method `check()` 
that must return instance of `\Saritasa\LaravelHealthCheck\Contracts\CheckResult::class`

# Usage
Package exposes endpoints to run all checks or run each check by name:
## GET /health-check
Runs all known checks and returns HTTP code = 200, if all checks succeeded, 500 otherwise.
Response contains JSON with pares of check name and true/false indicating if checker completed successfully or not.

## GET /health-check/{checker}
Where **{checker}** is a key from `config/health_check.php`, ex. `GET /health-check/database`.  
Returns HTTP code = 200, if checker reports success, 500 otherwise. 
Response content is payload, returned by checker.

## Available checkers
#### Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker  
Checks, if default connection to DB, configured in Laravel is available - tries to establish connection with server.

#### Saritasa\LaravelHealthCheck\Checkers\RedisHealthChecker  
Checks, if redis connection is available - tries to establish connection with server.

#### Saritasa\LaravelHealthCheck\Checkers\S3HealthChecker  
Checks, if application can read from default S3 bucket - tries to get enumerate entries in S3 bucket.

## Contributing  
  
1. Create fork, checkout it  
2. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)** -  
    run [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to ensure, that code follows style guides  
3. **Cover added functionality with unit tests** and run [PHPUnit](https://phpunit.de/) to make sure, that all tests pass  
4. Update [README.md](README.md) to describe new or changed functionality  
5. Add changes description to [CHANGES.md](CHANGES.md) file. Use [Semantic Versioning](https://semver.org/) convention to determine next version number.  
6. When ready, create pull request  
