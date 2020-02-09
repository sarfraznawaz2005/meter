<?php

namespace Sarfraznawaz2005\Meter\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Type;
use Tests\TestCase;

class MeterModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_save_entries()
    {
        $model = factory(MeterModel::class)->create(['type' => Type::EVENT, 'No', 'test content']);

        $this->assertEquals('test content', $model->content);
    }
}
