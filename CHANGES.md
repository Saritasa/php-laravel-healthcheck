# Changes History

1.2.0
-----
* Declare compatibility with Laravel 10.

1.1.0
-----
+ Add `NullChecker` - use if you need to check HTTP connection to server only.
* Declare compatibility with Laravel 9.

1.0.1
-----
+ Add error message to response body, when check failed

1.0.0
-----
+ Implement `GET /health-check/{checker}` endpoint - allows to run single check by name from `config/health_check.php`
ex. `GET /health-check/database`
* Get rid of custom factory.

0.1.0
-----
Initial version. Implements checks for DB, Redis, S3.
