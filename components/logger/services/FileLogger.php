<?php

namespace app\components\logger\services;

class FileLogger implements LoggerServiceInterface
{
    public function send(string $message): void
    {
        $path = '../runtime/logs/app.log';

        file_put_contents($path, $message . PHP_EOL, FILE_APPEND);
    }
}
