<?php

namespace Application\Model;

class DatabaseManager {
    private $db;

    public function __construct(\PDO $dbConnection) {
        $this->db = $dbConnection;
    }

    public function fetchByStatusType($statusType) {
        $result = $this->db->query("SELECT * FROM asset_statuses WHERE status_type='{$statusType}'");
        $assets = [];
        while ($result && $row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $assetStatus = new AssetStatus(
                $row['id'],
                $row['asset_id'],
                $row['status_type'],
                $row['created_at']
            );
            $assets[] = new Asset(
                $assetStatus->getAssetId(),
                $assetStatus
            );
        }
        return $assets;
    }
}