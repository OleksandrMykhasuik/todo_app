<?php

namespace App\Component\Message;

use App\Entity\Message;

interface MessageGeneratorInterface
{
    public function generateRandomString(): Message;
}
