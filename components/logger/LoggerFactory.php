<?php

namespace app\components\logger;

use app\components\logger\services\DbLogger;
use app\components\logger\services\EmailLogger;
use app\components\logger\services\FileLogger;
use app\components\logger\services\LoggerServiceInterface;

class LoggerFactory implements LoggerFactoryInterface
{
    private const TYPES = [
        'email' => EmailLogger::class,
        'file' => FileLogger::class,
        'db' => DbLogger::class
    ];

    public static function getTypes(): array
    {
        return array_keys(self::TYPES);
    }

    public static function getConfigs(): array
    {
        return require __DIR__ . '/../../config/logger.php';
    }

    public function create(string $loggerType): LoggerServiceInterface
    {
        if (!array_key_exists($loggerType, self::TYPES)) {
            throw new \InvalidArgumentException('Invalid logger type');
        }

        $loggerClass = self::TYPES[$loggerType];
        return new $loggerClass();
    }
}
