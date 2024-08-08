<?php

namespace app\components\logger\services;

interface LoggerServiceInterface
{
    /**
     * Sends message.
     *
     * @param string $message
     */
    public function send(string $message): void;
}
