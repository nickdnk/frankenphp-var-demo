<?php

namespace MyApp;

class SomeOtherClass
{

    public static function SomeStaticFunction(): void
    {

        // This will crash the first time but work the second time.
        echo $_ENV['my_var'];

    }

}