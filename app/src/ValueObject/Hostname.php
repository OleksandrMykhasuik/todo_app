<?php

namespace App\ValueObject;

class Hostname
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $name
    ) {

    }
}
