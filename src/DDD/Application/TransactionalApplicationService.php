<?php

namespace App\DDD\Application;

use Webmozart\Assert\Assert;

/**
 * Decorator
 * Class TransactionalApplicationService
 * @package App\DDD\Application
 */
class TransactionalApplicationService implements ApplicationService
{
    /**
     * @var ApplicationService
     */
    private $service;

    /**
     * @var TransactionalSession
     */
    private $session;

    /**
     * @param ApplicationService $service
     * @param TransactionalSession $session
     */
    public function __construct(ApplicationService $service, TransactionalSession $session)
    {
        $this->session = $session;
        $this->service = $service;
    }

    /**
     * @param null $request
     * @return mixed
     */
    public function execute($request = null)
    {
        $operation = function () use ($request) {
            return $this->service->execute($request);
        };

        return $this->session->executeAtomically($operation);
    }
}