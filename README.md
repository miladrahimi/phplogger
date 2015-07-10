# PHPLogger
Free PHP logger for neat and powerful projects!


## Documentation
PHP Logger is package for PHP developers to log.
It implemented based on [PSR-3](http://www.php-fig.org/psr/psr-3) Standard.

### Installation
#### Using Composer
It's strongly recommended to use [Composer](http://getcomposer.org).
If you are not familiar with Composer, The article
[How to use composer in php projects](http://miladrahimi.com/blog/2015/04/12/how-to-use-composer-in-php-projects)
can be useful.
After installing Composer, go to your project directory and run following command there:
```
php composer.phar require miladrahimi/phplogger
```
Windows:
```
composer require miladrahimi/phplogger
```
Or if you have `composer.json` file already in your application,
you may add this package to your application requirements
and update your dependencies:
```
"require": {
    "miladrahimi/phplogger": "dev-master"
}
```
```
php composer.phar update
```
Windows:
```
composer update
```
#### Manually
You can use your own autoloader as long as it follows [PSR-0](http://www.php-fig.org/psr/psr-0) or
[PSR-4](http://www.php-fig.org/psr/psr-4) standards.
In this case you can put `src` directory content in your vendor directory.

### Getting Started
PHPLogger has potential to store logs into different kinds of storage,
but for now you can only use directory (filesystem) to store them. 
Following codes demonstrate how to define directory storage: 
```
use MiladRahimi\PHPLogger\Directory;
$dir = new Directory("./logs/");
```
Then you can use PHPLogger with the directory storage which is defined above:
```
use MiladRahimi\PHPLogger\Logger;
$logger = new Logger();
$logger->addStorage($dir);
```
Now you may store your first log:
```
$logger->alert("This is an alert!");
```
Alert is not only supported log level,
so you may see all supported log level out there in [PSR-3](http://www.php-fig.org/psr/psr-3) page.

### Log method
The broader method is `Logger::log()` method which gets log level as its first parameter.
Following example show how to use this method:
```
use MiladRahimi\PHPLogger\Logger;
use MiladRahimi\PHPLogger\Directory;

$directory = new Directory(__DIR__);

$logger = new Logger();
$logger->addStorage($directory);
$logger->log("alert", "This is an alert message!");
```
To follow standards you may use `LogLevel` constants which are provided by PSR-3 standard.
```
use MiladRahimi\PHPLogger\Logger;
use MiladRahimi\PHPLogger\Directory;
use Psr\Log\LogLevel;

$directory = new Directory(__DIR__);

$logger = new Logger();
$logger->addStorage($directory);
$logger->log(LogLevel::ALERT, "This is an error message!");
```

## Contributors
*	[Milad Rahimi](http://miladrahimi.com)

## Homepage
*   [PHPLogger](http://miladrahimi.github.io/phplogger)

## License
PHPRouter is released under the [MIT License](http://opensource.org/licenses/mit-license.php).
