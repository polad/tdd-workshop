<?php

namespace ApplicationTest\Model;

use Application\Model\Asset;
use Application\Model\AssetStatus;
use Application\Model\AssetManager;

use PHPUnit\Framework\TestCase;

class AssetManagerTest extends TestCase {
  public function testShouldReturnAnAssetIfDataIsPassed() {
    // Given
    $assetData = [
      "id" => "181c5e36-05ae-42aa-89c7-c42a24934660",
      "status" => [
          "id" => "d4250e33-f81f-408f-855a-36414fe4cee5",
          "assetId" => "181c5e36-05ae-42aa-89c7-c42a24934660",
          "statusType" => "ERROR",
          "createdAt" => "2010-09-07T01:48:20Z"
      ]
    ];

    $assetStatus = new AssetStatus(
      $assetData['id'],
      $assetData['asset_id'],
      $assetData['status_type'],
      $assetData['created_at']
    );

    $expectedAsset = new Asset($assetStatus->getAssetId(), $assetStatus);

    // When
    $asset = AssetManager::buildAsset($assetData);

    // Then
    $this->assertEquals($expectedAsset, $asset);
  }

  public function testShouldThrowExceptionIfDataIsNotPassed() {
    // Given
    $assetData = [];

    // When
    $asset = AssetManager::buildAsset($assetData);

    // Then
    $this->expectException(ArgumentCountError::class);
  }
}