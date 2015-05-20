# PHPLogger
Free PHP logger for neat and powerful projects!

# Intro
PHPLogger is a easy-to-use and standard logger which you should use in your PHP projects. 
Loggers make debugging dramatically simpler and 
for large-scale projects it is a requirement, not a arbitrary option! 
PHPLogger currently support only directory and filesystem storage but it is supposed to store logs 
into different kinds of storage like database and email ASAP.

# PSR-3 Standards
This package is bulit based on [PSR-3](http://www.php-fig.org/psr/psr-3) standards 
and implements its abstract classes so you need to install it too.

# Overview
PHPLogger has potential to store logs into different kinds of storage 
but for now you only can use directoy (filesystem) to store them. 
Following codes demonstrate how to define directory storage: 
```
$dir = new Neatplex\PHPLogger\Directory("./logs/");
```
Then you can use PHPLogger with the directory storage which is defined above:
```
$logger = new Neatplex\PHPLogger\Logger($dir);
```
Of course you can inject $dir with `setStorage()` method.
Now you may store your first log:
```
$logger->alert("This is an alert!");
```
Alert is not only supported log level, so you may see all supported log level out there in [PSR-3](http://www.php-fig.org/psr/psr-3) page.

# Installation

## Using Composer
It's strongly prefered to install package using [composer](https://getcomposer.org)! 
If you are not familiar with it, you may read this blog post about [How to use composer in PHP projects](http://miladrahimi.com/blog/2015/04/12/how-to-use-composer-in-php-projects).
Add this package to your `composer.json`:  
```
"require": {
	"neatplex/phplogger": "dev-master"
}
```
or if you prefer command line, change directory to project root and:
```
php composer.phar require "neatplex/phplogger":"dev-master"
```

## Manual Installation
Get a copy of the package source code and [PSR-3 Log](https://github.com/php-fig/log) package, 
then copy them into your projects. 
Caution your autoloader has to support [PSR-4 Log](http://www.php-fig.org/psr/psr-4) standard 
to autload this two package appropriately.

# Documentation
You may see official documentation in http://neatplex.com/project/phplogger

# License
PHPLogger is created by [Neatplex](http://neatplex.com) and released under the [MIT License](http://opensource.org/licenses/mit-license.php).
