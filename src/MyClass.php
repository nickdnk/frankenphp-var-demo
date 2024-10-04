<?php

namespace MyApp;

class MyClass
{

    public function bootstrap(): void
    {

        $_ENV['my_var'] = 'value is defined!';

    }

}