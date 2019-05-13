<?php

namespace Application\Service;

use \Zend\Log\Logger;
use \Zend\Log\Writer\Stream;

class SocketManager {

    private $logger;

    public function __construct() {
        $writer = new Stream('php://stdout');
        $this->logger = new Logger;
        $this->logger->addWriter($writer);
    }

    public function emit($message) {
        // send the message over a web socket
        $this->logger->info($message);
    }
}
