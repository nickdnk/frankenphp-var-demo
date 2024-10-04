<?php

use MyApp\MyClass;
use MyApp\SomeOtherClass;

require 'vendor/autoload.php';

$app = new MyClass();
$app->bootstrap(); // This sets our $_ENV - doesn't really matter if we do it manually or via dotenv

// Create a copy of the env we can pass to the handler
$env = array_merge($_ENV);

// Observe that the defined var gets logged correctly here:
error_log('After bootstrap: ' . json_encode($_ENV['my_var']) . PHP_EOL);

$handler = static function () use ($app, $env) {

    // Copy the variables back into the currently scoped $_ENV - without this, it doesn't work at all.
    $_ENV = array_merge($_ENV, $env);

    // Crashes the first time, after that.
    SomeOtherClass::SomeStaticFunction();

};

while (true) {
    $keepRunning = \frankenphp_handle_request($handler);

    // Call the garbage collector to reduce the chances of it being triggered in the middle of a page generation
    gc_collect_cycles();

    if (!$keepRunning) {
        break;
    }
}
