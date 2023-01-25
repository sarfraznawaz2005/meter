[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

# Laravel Meter

Laravel Meter monitors application performance for different things such as requests, commands, queries, events, etc and presents results in tables/charts. Think of it like Laravel Telescope but for performance monitoring. 

## Requirements ##

 - PHP >= 7.3
 - Laravel 5.5+ | 6

## Configuration

Available options are:
- METER_DB_CONNECTION 
  ` Database connection to use for meter entries. Default: mysql (uses default connection) `
- METER_PATH 
 ` Path to access meter UI. Default: meter `
- METER_USERNAME 
 ` Username to access meter UI. Default: null `
- METER_PASSWORD 
 ` Password to access meter UI. Default: null `
- ignore_matched_string 
 ` It helps to ignore the matched string in the query. Ex:`
 
 ```php
 "ignore_matched_string" => [
        "query" => [
            "information_schema",
        ]

    ],
```

There are more options available, please check `config/meter.php` file for more details.
 
## Monitors ## 

- Requests
- Queries
- Commands
- Events
- Schedule
- CPU Load
- Disk Space
- Server Memory
- HTTP Connections

## Screenshot ##

![Main Window](https://github.com/sarfraznawaz2005/meter/blob/master/screenshot.png?raw=true)


## Installation ##

Install via composer

```
composer require sarfraznawaz2005/meter
```


Publish package's config file by running below command:

```bash
php artisan vendor:publish --provider="Sarfraznawaz2005\Meter\MeterServiceProvider"
```
It should publish `config/meter.php` config file and migration file.

Now run `php artisan migrate` command to create `meter_entries` database table.

## Usage ##

Enable Meter in `config/meter.php` and setup any other options as needed. Meter UI will be visible at `path` config you set.

By default Meter monitors:

- Requests
- Queries
- Commands
- Events
- Schedule

To monitor server stuff:

- CPU Load
- Disk Space
- Server Memory
- HTTP Connections

You should use `meter:servermonitor` command. Schedule it in Laravel's console kernel file accordingly:
                           
```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->command('meter:servermonitor')->hourly(); // or daily
}
```
## Authentication ##

You can use `username` and `password` config options to setup basic HTTP authentication for Meter interface to be accessed. Once setup, user should provide correct username and password to access Meter page(s).

Alternatively, you can use `middleware` config option to apply your own auth middleware, etc 

## Ignoring Things ##

You can use `ignore_paths` and `ignore_commands` config options to ignore desired pages or commands from being monitored by Meter.

## Data Pruning ##

You need to periodically remove meter data otherwise your database will turn big quickly. To prune meter data, you can setup prune command in Kernel file:

```php
$schedule->command('meter:prune')->daily();
// or
$schedule->command('meter:prune --days=7')->daily();
```

## Contributing

PRs are welcome. Thanks

## Security

If you discover any security related issues, please email sarfraznawaz2005@gmail.com instead of using the issue tracker.

## Credits

- [Sarfraz Ahmed][link-author]
- [All Contributors][link-contributors]

## License

Please see the [license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sarfraznawaz2005/meter.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sarfraznawaz2005/meter.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sarfraznawaz2005/meter
[link-downloads]: https://packagist.org/packages/sarfraznawaz2005/meter
[link-author]: https://github.com/sarfraznawaz2005
[link-contributors]: https://github.com/sarfraznawaz2005/meter/graphs/contributors
