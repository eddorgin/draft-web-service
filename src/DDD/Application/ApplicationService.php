<?php

namespace App\DDD\Application;

/**
 * Interface ApplicationService
 * @package App\DDD\Application
 */
interface ApplicationService
{
    /**
     * @param $request
     * @return mixed
     */
    public function execute($request);
}