<?php

use App\User;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    protected $defaultUser;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function defaultUser($attributes = [])
    {
        if($this->defaultUser) {
            return $this->defaultUser;
        }

        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    public function seeInField($selector, $expected)
    {   
        $this->assertSame(
            $expected,
            $this->getInputOrTextAreaValue($selector),
            "The input [{$selector}] has not the value [{$expected}]"
        );
    }

    public function getInputOrTextAreaValue($selector)
    {
        $field = $this->filterByNameOrId($selector);

        if ($field->count() == 0) {
            throw new \Exception("There are no elements with the name or ID [$selector]");
        }

        $element = $field->nodeName();

        if($element == 'input') {
            return $field->attr('value');
        }

        if($element == 'textarea') {
            return $field->text();
        }

        throw new \Exception("[$selector] is neither an input or a textarea");
    }

    protected function createPost(array $attributes = [])
    {
        return factory(\App\Post::class)->create($attributes);
    }
}
