<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

use Application\Model\AssetStatus;
use Application\Model\Consumer;
use Application\Model\Event;
use Application\Model\StatusType;
use Application\Service\SocketManager;

class AssetStatusesController extends AbstractActionController
{
    private $consumers;
    private $db;

    public function __construct(\PDO $dbConnection, SocketManager $socketManager) {
        $this->db = $dbConnection;

        $this->consumers = [];

        $consumer1 = new Consumer("Paul", [ $socketManager, 'emit' ]);
        $consumer1->subscribe([
            Event::ASSET_FAILED,
            Event::ASSET_MAY_FAIL,
            Event::ASSET_RECOVERED,
            Event::ASSET_FAILED_ABRUPTLY,
        ]);
        $this->addConsumer($consumer1);

        $consumer2 = new Consumer("Kyle", function($message) use ($socketManager) {
            $socketManager->emit("Kyle screams: {$message}");
        });
        $consumer2->subscribe([
            Event::ASSET_FAILED_ABRUPTLY,
        ]);
        $this->addConsumer($consumer2);
    }

    public function saveAssetStatusAction() {
        $requestContent = json_decode($this->request->getContent(), true);
        $assetStatus = new AssetStatus(
            $requestContent['id'],
            $requestContent['assetId'],
            strtoupper($requestContent['statusType']),
            $requestContent['createdAt']
        );
        $oldStatus = null;
        $assetId = $requestContent['assetId'];
        $result = $this->db->query("SELECT id, asset_id, status_type, created_at FROM asset_statuses WHERE asset_id='{$assetId}'");
        if ($result->rowCount()) {
            $row = $result->fetch(\PDO::FETCH_NUM);
            $oldStatus = new AssetStatus(...$row);
        }
        $id = $assetStatus->getId();
        $assetId = $assetStatus->getAssetId();
        $statusType = $assetStatus->getStatusType();
        $createdAt = $assetStatus->getCreatedAt();
        if ($oldStatus) {
            $this->db->query("UPDATE asset_statuses SET id='{$id}', status_type='{$statusType}', created_at='{$createdAt}' WHERE asset_id='{$assetId}'");
        } else {
            $isSuccess = $this->db->query("INSERT INTO asset_statuses (id, asset_id, status_type, created_at) VALUES ('{$id}', '{$assetId}', '{$statusType}', '{$createdAt}')");
            if ($isSuccess) {
                $this->response->setStatusCode(201);
            }
        }
        $event = $this->createEvent(
            $assetStatus->getStatusType(),
            $oldStatus ? $oldStatus->getStatusType() : null
        );
        $this->notifyConsumers($event, $assetStatus);
        return new JsonModel($assetStatus->jsonSerialize());
    }

    private function createEvent($newStatusType, $oldStatusType) {
        $event = null;

        if (($oldStatusType != StatusType::NORMAL && $newStatusType == StatusType::NORMAL)
            && ($oldStatusType != null && $newStatusType == StatusType::NORMAL)) {

            $event = Event::ASSET_RECOVERED;

        } elseif ($oldStatusType != StatusType::WARNING
                   && $newStatusType == StatusType::WARNING) {

            $event = Event::ASSET_MAY_FAIL;

        } elseif ($oldStatusType == StatusType::WARNING
                   && $newStatusType == StatusType::ERROR) {

            $event = Event::ASSET_FAILED;

        } elseif (($oldStatusType == StatusType::NORMAL || $oldStatusType == null)
                   && $newStatusType == StatusType::ERROR) {

            $event = Event::ASSET_FAILED_ABRUPTLY;

        }

        return $event;
    }

    private function notifyConsumers($event, $assetStatus) {
        if ($event != null) {
            foreach ($this->consumers as $consumer) {
                $consumer->emit($event, $assetStatus);
            }
        }
    }

    private function addConsumer(Consumer $consumer) {
        $this->consumers[] = $consumer;
    }
}
