<?php

namespace Application\Model;

class Consumer extends EventEmitter {
    private $name;
    private $eventHandler;

    public function __construct($name, Callable $eventHandler) {
        parent::__construct();
        $this->name = $name;
        $this->eventHandler = $eventHandler;
    }

    public function subscribe($eventTypes) {
        foreach ($eventTypes as $eventType) {

            if ($eventType == Event::ASSET_MAY_FAIL) {

                $this->on(Event::ASSET_MAY_FAIL, function ($assetStatus) {
                    $message = "Asset {$assetStatus->getAssetId()} is about to fail with status WARNING at {$assetStatus->getCreatedAt()}";
                    call_user_func($this->eventHandler, $message);
                });

            } elseif ($eventType == Event::ASSET_FAILED) {

                $this->on(Event::ASSET_FAILED, function ($assetStatus) {
                    $message = "Asset {$assetStatus->getAssetId()} has eventually failed with status ERROR {$assetStatus->getCreatedAt()}";
                    call_user_func($this->eventHandler, $message);
                });

            } elseif ($eventType == Event::ASSET_FAILED_ABRUPTLY) {

                $this->on(Event::ASSET_FAILED_ABRUPTLY, function ($assetStatus) {
                    $message = "Asset {$assetStatus->getAssetId()} has abruptly failed with status ERROR at {$assetStatus->getCreatedAt()}";
                    call_user_func($this->eventHandler, $message);
                });

            } elseif ($eventType == Event::ASSET_RECOVERED) {

                $this->on(Event::ASSET_RECOVERED, function ($assetStatus) {
                    $message = "Asset {$assetStatus->getAssetId()} has recovered with status NORMAL at {$assetStatus->getCreatedAt()}";
                    call_user_func($this->eventHandler, $message);
                });

            } else {

                throw new Exception("Trying to subscribe to unknown event: " + $eventType);

            }
        }
    }
}