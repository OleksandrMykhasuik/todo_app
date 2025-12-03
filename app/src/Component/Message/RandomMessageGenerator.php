<?php

namespace App\Component\Message;

use App\Entity\Message;

class RandomMessageGenerator implements MessageGeneratorInterface
{
    private const MESSAGES = [
        'first message',
        'second message',
        'third message',
    ];

    public function generateRandomString(): Message
    {
        $result = new Message(
            self::MESSAGES [
                \array_rand(self::MESSAGES)
            ]
        );

        return $result;
    }
}
