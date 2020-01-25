<?php

interface CommandRequestHandler
{
    public function handle(CommandRequest $commandRequest);
}