<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

use Application\Model\Asset;
use Application\Model\AssetStatus;
use Application\Model\DatabaseManager;

class AssetsController extends AbstractActionController
{
    private $db;
    private $dbManager;

    public function __construct(\PDO $dbConnection, DatabaseManager $databaseManager) {
        $this->db = $dbConnection;
        $this->dbManager = $databaseManager;
    }

    public function indexAction() {
        $statusType = $this->params()->fromQuery('status');
        $assets = $this->dbManager->fetchByStatusType($statusType);
        return new JsonModel($assets);
    }

    public function getByIdAction() {
        $assetId = $this->params('id');
        $result = $this->db->query("SELECT id, asset_id, status_type, created_at FROM asset_statuses WHERE asset_id='{$assetId}'");
        if ($result && $result->rowCount()) {
            $row = $result->fetch(\PDO::FETCH_NUM);
            $assetStatus = new AssetStatus(...$row);
            $asset = new Asset($assetId, $assetStatus);
            return new JsonModel($asset->jsonSerialize());
        }
        $this->response->setStatusCode(404);
        return;
    }
}
