<?php

interface ApplicationService
{
    public function execute(CommandRequest $request);
}