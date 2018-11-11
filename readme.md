Simple SF4 Basket App
=====================

Requirements
------------

  * PHP 7.1.3 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][1].

Installation
------------
After cloning this project from github navigate to the project directory and execute the following commands :

```bash
 $ composer install
 $ php bin/console doctrine:database:create
 $ php bin/console doctrine:migrations:migrate
 $ php bin/console doctrine:fixtures:load
 $ yarn encore production
 $ php bin/console server:run
```
 
Then access the application in your browser at <http://localhost:8000>


Testing
------------
For running unit tests and functional tests execute :
```bash
 $ ./bin/phpunit
```


[1]: https://symfony.com/doc/current/reference/requirements.html