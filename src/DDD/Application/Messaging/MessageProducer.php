<?php

namespace App\DDD\Application\Messaging;

interface MessageProducer
{
    public function open($exchange);
    public function send($exchange, Message $message);
    public function close($exchange);
}