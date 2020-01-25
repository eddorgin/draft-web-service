<?php

use Webmozart\Assert\Assert;

/**
 * Decorator
 * Class TransactionalApplicationService
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
     * @param CommandRequest $request
     *
     * @return mixed
     */
    public function execute(CommandRequest $request)
    {
        Assert::isEmpty($request);

        $operation = function () use ($request) {
            return $this->service->execute($request);
        };

        return $this->session->executeAtomically($operation);
    }
}