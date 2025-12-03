<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class SNMPWalkResult
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly array $content,
    ) {
    }
}
