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
composer require miladrahimi/phplogger
```

Or if you have `composer.json` file already in your application,
you may add this package to your application requirements
and update your dependencies:

```
"require": {
    "miladrahimi/phplogger": "~1.5"
}
```

```
composer update
```

#### Manually
You can use your own autoloader as long as it follows [PSR-0](http://www.php-fig.org/psr/psr-0) or
[PSR-4](http://www.php-fig.org/psr/psr-4) standards.
In this case you can put `src` directory content in your vendor directory.
This package has a dependency to `psr/log` package,
which if you install manually,
you need to install it too.

### Getting Started
PHPLogger has potential to store logs into different kinds of storage,
but for now you can only use directory (filesystem) to store them. 
Following codes illustrate how to define a directory storage
and inject it to Logger class:

```
use MiladRahimi\PHPLogger\Logger;
use MiladRahimi\PHPLogger\Directory;

$dir = new Directory("./logs/");
$logger = new Logger($dir);
```

As you see above, you can inject storage via Logger constructor,
but if you want to use more storage,
you can add them via following method:

```
$logger->addStorage($my_storage);
```

Now you may store your first log:

```
$logger->alert("This is an alert!");
```

Alert is not only supported log level,
you may see all supported log level out there in [PSR-3](http://www.php-fig.org/psr/psr-3) page.

### Log method
The broader method for logging is `Logger::log()` method which gets log level as its first parameter.
Following example show how to use this method:

```
use MiladRahimi\PHPLogger\Logger;
use MiladRahimi\PHPLogger\Directory;

$directory = new Directory(__DIR__);
$logger = new Logger($directory);
$logger->log("alert", "This is an alert message!");
```

To follow standards you may use `LogLevel` constants which are provided by PSR-3 standard.

```
use MiladRahimi\PHPLogger\Logger;
use MiladRahimi\PHPLogger\Directory;
use Psr\Log\LogLevel;

$logger = new Logger(new Directory(__DIR__));
$logger->log(LogLevel::ALERT, "This is an error message!");
```

### Context
Context is the third parameter in `Logger::log()` method
and second one for direct level log methods like `Log::alert()`.
This parameter can be an array or an object which you may use to store more details alongside your log message.

## Contributors
*	[Milad Rahimi](http://miladrahimi.com)

## Homepage
*   [PHPLogger](http://miladrahimi.github.io/phplogger)

## License
PHPRouter is released under the [MIT License](http://opensource.org/licenses/mit-license.php).
