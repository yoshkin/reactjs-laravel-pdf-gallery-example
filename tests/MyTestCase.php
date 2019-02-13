<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class MyTestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://pdf-gallery-example.local';
}
