<?php

namespace app\components\logger;

use app\components\logger\services\LoggerServiceInterface;

interface LoggerFactoryInterface
{
    /**
     * Creates logger by type.
     *
     * @param string $type
     *
     * @return LoggerServiceInterface
     */
    public function create(string $type): LoggerServiceInterface;
}
