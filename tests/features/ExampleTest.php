<?php

class ExampleTest extends FeatureTestCase
{
    /** @test */
    public function test_basic_example()
    {
        $user = factory(\App\User::class)->create(['name' => 'Rubens']);

        $this->actingAs($user, 'api')
             ->visit('/api/user')
             ->see('Rubens');
    }
}
