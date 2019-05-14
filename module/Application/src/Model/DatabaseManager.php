<?php

namespace Application\Model;

class DatabaseManager {
    private $db;

    public function __construct(\PDO $dbConnection) {
        $this->db = $dbConnection;
    }

    public function fetchByStatusType($statusType) {
        $result = $this->db->query("SELECT id, asset_id, status_type, created_at FROM asset_statuses WHERE status_type='{$statusType}'");
        $assets = [];
        while ($row = $result->fetch(\PDO::FETCH_NUM)) {
            $assetStatus = new AssetStatus(...$row);
            $assets[] = new Asset(
                $assetStatus->getAssetId(),
                $assetStatus
            );
        }
        return $assets;
    }
}