## How to use it

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