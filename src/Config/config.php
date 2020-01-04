<?php

return [

    // Enable/Disable Meter
    'enabled' => env('METER_ENABLED', true),

    #---------------------------------------------------------------------

    /*
    * This is the subdomain where Meter will be accessible from. If the
    * setting is null, Meter will reside under the same domain as the
    * application.
    */

    'domain' => env('METER_DOMAIN', null),

    #---------------------------------------------------------------------

    /*
     * URI path Meter will be accessible from.
     *
     * Username and password for basic http authentication to access
     * meter interface.
     */

    'path' => env('METER_PATH', 'meter'),
    'username' => env('METER_USERNAME', 'meter'),
    'password' => env('METER_PASSWORD', 'meter'),

    #---------------------------------------------------------------------

    /*
    * These middleware will be assigned to every Meter route, giving you
    * the chance to add your own middleware to this list or change any of
    * the existing middleware.
    */

    'middleware' => [
        //
    ],

    #---------------------------------------------------------------------

    /*
    | The following array lists the URI paths and Artisan commands that will
    | not be watched by Meter. In addition to this list, some Laravel
    | commands like migrations and queue commands are always ignored.
    */

    'ignore_paths' => [
        //
    ],

    'ignore_commands' => [
        //
    ],

    #---------------------------------------------------------------------

    // Customize the monitors meter will use to show statiscs of.
    'monitors' => [
        Sarfraznawaz2005\Meter\Monitors\RequestMonitor::class => [
            'enabled' => env('METER_REQUEST_MONITOR', true),
            'slow' => 3000, // considered slow if equal or over given time in ms
        ],

        Sarfraznawaz2005\Meter\Monitors\QueryMonitor::class => [
            'enabled' => env('METER_QUERY_MONITOR', true),
            'ignore_packages' => true,
            'slow' => 300, // considered slow if equal or over given time in ms
        ],

        Sarfraznawaz2005\Meter\Monitors\CommandMonitor::class => [
            'enabled' => env('METER_COMMAND_MONITOR', true),
            'ignore' => [],
        ],

        Sarfraznawaz2005\Meter\Monitors\EventMonitor::class => [
            'enabled' => env('METER_EVENT_MONITOR', true),
            'ignore' => [],
        ],
    ]
];
