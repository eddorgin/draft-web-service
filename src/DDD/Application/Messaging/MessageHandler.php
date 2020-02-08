<?php

namespace App\DDD\Application\Messaging;

interface MessageHandler
{
    public function handle(Message $message);
}