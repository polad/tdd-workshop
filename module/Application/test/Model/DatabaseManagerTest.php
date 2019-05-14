<?php

namespace ApplicationTest\Model;

use Application\Model\Asset;
use Application\Model\AssetStatus;
use Application\Model\DatabaseManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophet;

class DatabaseManagerTest extends TestCase {

    private $databaseManager;
    private $dbConnection;
    private $pdoStatement;

    public function setUp() {
        $statusType = 'ERROR';

        $prophet = new Prophet();
        $sql = "SELECT * FROM asset_statuses WHERE status_type='{$statusType}'";

        $this->pdoStatement = $prophet->prophesize(\PDOStatement::class);

        $this->dbConnection = $prophet->prophesize(\PDO::class);
        $this->dbConnection->query($sql)
            ->shouldBeCalledTimes(1)
            ->willReturn($this->pdoStatement);

        $this->databaseManager = new DatabaseManager($this->dbConnection->reveal());
    }

    public function testShouldReturnAssetsByStatusType() {
        // Given
        $statusType = 'ERROR';

        $expectedAssetStatusRow = [
            'id' => 'd4250e33-f81f-408f-855a-36414fe4cee5',
            'asset_id' => '181c5e36-05ae-42aa-89c7-c42a24934660',
            'status_type' => 'ERROR',
            'created_at' => '2010-09-07T01:48:20Z'
        ];

        $numCalls = 1;
        $this->pdoStatement->fetch(\PDO::FETCH_ASSOC)
            ->shouldBeCalledTimes(2)
            ->will(function() use ($expectedAssetStatusRow, &$numCalls) {
                return $numCalls-- ? $expectedAssetStatusRow : false;
            });

        $expectedAssets = [
            new Asset(
                $expectedAssetStatusRow['asset_id'],
                new AssetStatus(
                    $expectedAssetStatusRow['id'],
                    $expectedAssetStatusRow['asset_id'],
                    $expectedAssetStatusRow['status_type'],
                    $expectedAssetStatusRow['created_at']
                )
            )
        ];

        // When
        $assets = $this->databaseManager->fetchByStatusType($statusType);

        // Then
        $this->assertEquals(
            $expectedAssets,
            $assets
        );
    }

    public function testShouldReturnEmptyArrayIfNoAssetsFound() {
        // Given
        $statusType = 'ERROR';

        $this->pdoStatement
            ->fetch(\PDO::FETCH_ASSOC)
            ->willReturn(false);

        // When
        $assets = $this->databaseManager->fetchByStatusType($statusType);

        // Then
        $this->assertEquals(
            [],
            $assets
        );

    }
}