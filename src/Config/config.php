<?php

return [

    // Enable/Disable Meter
    'enabled' => env('METER_ENABLED', false),

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
            'graph_type' => env('METER_REQUEST_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_REQUEST_ON_DASHBOARD', true)
        ],

        Sarfraznawaz2005\Meter\Monitors\QueryMonitor::class => [
            'enabled' => env('METER_QUERY_MONITOR', true),
            'ignore_packages' => true,
            'slow' => 500, // considered slow if equal or over given time in ms
            'graph_type' => env('METER_QUERY_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_QUERY_ON_DASHBOARD', true)
        ],

        Sarfraznawaz2005\Meter\Monitors\CommandMonitor::class => [
            'enabled' => env('METER_COMMAND_MONITOR', true),
            'ignore' => [],
            'graph_type' => env('METER_COMMAND_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_COMMAND_ON_DASHBOARD', true)
        ],

        Sarfraznawaz2005\Meter\Monitors\EventMonitor::class => [
            'enabled' => env('METER_EVENT_MONITOR', true),
            'ignore' => [],
            'graph_type' => env('METER_EVENT_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_EVENT_ON_DASHBOARD', true)
        ],

        Sarfraznawaz2005\Meter\Monitors\ScheduleMonitor::class => [
            'enabled' => env('METER_SCHEDULE_MONITOR', true),
            'graph_type' => env('METER_SCHEDULE_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_SCHEDULE_ON_DASHBOARD', true)
        ],

        #####################################################################
        # below monitors are run via "meter:servermonitor" command if enabled
        #####################################################################

        // monitors average CPU usage
        Sarfraznawaz2005\Meter\Monitors\CpuMonitor::class => [
            'enabled' => env('METER_CPU_MONITOR', false),
            'graph_type' => env('METER_CPU_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_CPU_ON_DASHBOARD', true)
        ],

        // monitors disk space usage
        Sarfraznawaz2005\Meter\Monitors\DiskSpaceMonitor::class => [
            'enabled' => env('METER_DISK_MONITOR', false),
            'graph_type' => env('METER_DISK_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_DISK_ON_DASHBOARD', true)
        ],

        // monitors server memory usage
        Sarfraznawaz2005\Meter\Monitors\MemoryMonitor::class => [
            'enabled' => env('METER_MEMORY_MONITOR', false),
            'graph_type' => env('METER_MEMORY_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_MEMOR_ON_DASHBOARD', true)
        ],

        // monitors active http connections count on port 80
        Sarfraznawaz2005\Meter\Monitors\HttpConnectionsMonitor::class => [
            'enabled' => env('METER_HTTP_CONNECTIONS_MONITOR', false),
            'port' => env('METER_HTTP_CONNECTIONS_PORT', 80),
            'graph_type' => env('METER_HTTP_CONNECTIONS_GRAPH_TYPE', 'bar'), // bar, line
            'show_on_dashboard' => env('METER_HTTP_CONNECTIONS_ON_DASHBOARD', true)
        ],
    ],

    // Graph/Table filters. Will be added between "Today" and "All".
    'filters' => [
        'Yesterday' => 1,
        'Week' => 7,
        'Month' => 30,
        '3 Month' => 90,
        '6 Month' => 180,
        'Year' => 365,
    ],
];
