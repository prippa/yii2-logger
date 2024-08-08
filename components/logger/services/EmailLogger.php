<?php

namespace app\components\logger\services;

use app\components\logger\LoggerFactory;
use Yii;

class EmailLogger implements LoggerServiceInterface
{
    private $email;

    public function __construct()
    {
        $configs = LoggerFactory::getConfigs();
        $this->email = $configs['email'];
    }

    public function send(string $message): void
    {
        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject('Log Message')
            ->setTextBody($message)
            ->send();
    }
}
