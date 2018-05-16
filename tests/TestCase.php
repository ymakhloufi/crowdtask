<?php

namespace Tests;

use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var Generator */
    protected $faker;


    public function setUp()
    {
        parent::setUp();
        \DB::disableQueryLog();
        \DB::beginTransaction();
        $this->faker = app(Generator::class);
    }


    public function tearDown()
    {
        \DB::rollBack();
        \DB::disconnect();
        parent::tearDown();
    }
}
