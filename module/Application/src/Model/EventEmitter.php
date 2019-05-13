<?php

namespace Application\Model;

class EventEmitter {

    private $callbacks;

    public function __construct() {
        $this->callbacks = [];
    }

    public function on($eventType, $callback) {
        if ($this->callbacks[$eventType] == null) {
            $this->callbacks[$eventType] = [];
        }
        $this->callbacks[$eventType][] = $callback;
    }

    public function emit($eventType, ...$rest) {
        if (is_array($this->callbacks[$eventType])) {
            foreach ($this->callbacks[$eventType] as $callback) {
                $callback(...$rest);
            }
        }
    }

}