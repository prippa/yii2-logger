<?php

namespace app\components\logger;

use app\components\logger\services\LoggerServiceInterface;

class Logger implements LoggerInterface
{
    private LoggerFactory $loggerFactory;
    private string $currentType;
    private array $loggerBuffer = [];

    public function __construct(string $type = null)
    {
        $configs = LoggerFactory::getConfigs();
        $this->loggerFactory = new LoggerFactory();
        $this->currentType = $type ?? $configs['defaultLoggerType'];
    }

    private function getLogger(string $type): LoggerServiceInterface
    {
        if (isset($this->loggerBuffer[$type])) {
            return $this->loggerBuffer[$type];
        }

        $logger = $this->loggerFactory->create($type);
        $this->loggerBuffer[$type] = $logger;

        return $logger;
    }

    public function send(string $message): void
    {
        $logger = $this->getLogger($this->currentType);
        $logger->send($message);
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        $logger = $this->getLogger($loggerType);
        $logger->send($message);
    }

    public function getType(): string
    {
        return $this->currentType;
    }

    public function setType(string $type): void
    {
        $this->currentType = $type;
    }
}
