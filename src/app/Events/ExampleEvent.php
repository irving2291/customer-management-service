<?php

namespace App\Events;

class ExampleEvent extends Event
{
    public $text;

    /**
     * ExampleEvent constructor.
     * @param string $text
     * @return void
     */
    public function __construct($text)
    {
        $this->text = $text;
    }
}
