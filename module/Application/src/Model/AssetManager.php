<?php

namespace Application\Model;

class AssetManager {
    public static function buildAsset($assetData) {
      $assetStatus = new AssetStatus(
        $assetData['id'],
        $assetData['asset_id'],
        $assetData['status_type'],
        $assetData['created_at']
      );

      return new Asset($assetStatus->getAssetId(), $assetStatus);
    }
}