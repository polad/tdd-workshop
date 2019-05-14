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
            $assets[] = AssetManager::buildAsset($row);
        }

        return $assets;
    }
}