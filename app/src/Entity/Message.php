<?php

namespace App\Entity;

class Message
{
    public function __construct(public readonly string $content)
    {
    }
}
