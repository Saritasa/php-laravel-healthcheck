# Changes History

1.0.0
-----
+ Implement `GET /health-check/{checker}` endpoint - allows to run single check by name from `config/health_check.php`
ex. `GET /health-check/database`
* Get rid of custom factory.

0.1.0
-----
Initial version. Implements checks for DB, Redis, S3.