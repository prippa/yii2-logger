<?php

namespace app\components\logger\services;

use app\models\Logs;

class DBLogger implements LoggerServiceInterface
{
    public function send(string $message): void
    {
        $log = new Logs();
        $log->message = $message;
        $log->save();
    }
}
