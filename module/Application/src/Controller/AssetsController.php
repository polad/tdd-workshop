<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

use Application\Model\Asset;
use Application\Model\AssetStatus;

class AssetsController extends AbstractActionController
{
    private $db;

    public function __construct(\PDO $dbConnection) {
        $this->db = $dbConnection;
    }

    public function indexAction() {
        $statusType = $this->params()->fromQuery('status');
        $result = $this->db->query("SELECT id, asset_id, status_type, created_at FROM asset_statuses WHERE status_type='{$statusType}'");
        $assets = [];
        while ($row = $result->fetch(\PDO::FETCH_NUM)) {
            $assetStatus = new AssetStatus(...$row);
            $assets[] = new Asset(
                $assetStatus->getAssetId(),
                $assetStatus
            );
        }
        return new JsonModel($assets);
    }

    public function getByIdAction() {
        $assetId = $this->params('id');
        $asset = new Asset($assetId);
        $result = $this->db->query("SELECT id, asset_id, status_type, created_at FROM asset_statuses WHERE asset_id='{$assetId}'");
        if ($result->rowCount()) {
            $row = $result->fetch(\PDO::FETCH_NUM);
            $assetStatus = new AssetStatus(...$row);
            $asset = new Asset($assetId, $assetStatus);
        }
        return new JsonModel($asset->jsonSerialize());
    }
}
