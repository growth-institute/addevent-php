![AddEvent for PHP](https://i.imgur.com/HjZmIm5.jpg)

# AddEvent for PHP

## What is this?

This library is a PHP tool to integrate [AddEvent](https://www.addevent.com/) API into your projects. AddEvent documentation can be found [here](https://www.addevent.com/documentation/calendar-api).

## How to use it

Simply require the package with `composer add growth-institute/addevent-php`.

Don't forget to include your vendor `autoload.php`. Then you will be able to instantiate an AddEvent object. The constructor receives the _AddEvent token_ as its only parameter. Example:

```php
<?php

	include('vendor/autoload.php');
	use AddEventPHP\AddEvent;

	$addevent = new AddEvent('your token here');

	$calendars = $addevent->listCalendars();

	echo "<pre>";
	print_r($calendars);
	echo "</pre>";
?>
```

Take a look to the src files to check all the functions available.