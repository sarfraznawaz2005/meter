<?php

namespace Sarfraznawaz2005\Meter\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ConsoleTest extends TestCase
{
    public function test_publish_command_works()
    {
        if (File::exists(public_path('vendor/meter/meter.css'))) {
            unlink(public_path('vendor/meter/meter.css'));
        }

        $this->assertFalse(File::exists(public_path('vendor/meter/meter.css')));

        Artisan::call('meter:publish');

        $this->assertTrue(File::exists(public_path('vendor/meter/meter.css')));
    }
}
