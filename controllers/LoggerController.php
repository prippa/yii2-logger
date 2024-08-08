<?php

namespace app\controllers;

use app\components\logger\Logger;
use app\components\logger\LoggerFactory;
use app\components\logger\LoggerInterface;
use yii\web\Controller;


class LoggerController extends Controller
{
    private LoggerInterface $logger;
    private array $loggerTypes;

    public function init()
    {
        parent::init();

        $this->loggerTypes = LoggerFactory::getTypes();
        $this->logger = new Logger();
    }

    private function getMessage(): string
    {
        return date('Y-m-d H:i:s') . ' - ' . 'Hello Logger!';
    }

    private function debug(string $message, string $type): void
    {
        print_r("\"{$message}\" was send via {$type}<br>");
    }

    public function actionLog()
    {
        $message = $this->getMessage();

        $this->logger->send($message);
        $this->debug($message, $this->logger->getType());
    }

    public function actionLogTo(string $type)
    {
        $message = $this->getMessage();

        $this->logger->sendByLogger($message, $type);
        $this->debug($message, $type);
    }

    public function actionLogToAll()
    {
        foreach ($this->loggerTypes as $type) {
            $message = $this->getMessage();

            $this->logger->setType($type);
            $this->logger->send($message);
            $this->debug($message, $type);
        }
    }
}
