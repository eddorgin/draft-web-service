<?php

interface MessageHandler
{
    public function handle(Message $message);
}