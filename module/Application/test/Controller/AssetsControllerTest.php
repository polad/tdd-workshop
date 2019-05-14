<?php

namespace ApplicationTest\Controller;

use Application\Controller\AssetsController;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class AssetsControllerTest extends AbstractHttpControllerTestCase {

    public function setUp()
    {
        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            []
        ));

        parent::setUp();
    }

    public function testShouldReturnAssetsWithGivenStatus() {
        // Given
        $expectedAssets = [
            [
                "id" => "181c5e36-05ae-42aa-89c7-c42a24934660",
                "status" => [
                    "id" => "d4250e33-f81f-408f-855a-36414fe4cee5",
                    "assetId" => "181c5e36-05ae-42aa-89c7-c42a24934660",
                    "statusType" => "ERROR",
                    "createdAt" => "2010-09-07T01:48:20Z"
                ]
            ]
        ];

        // When
        $this->dispatch('/assets?status=ERROR');

        // Then
        $this->assertResponseStatusCode(200);
        $this->assertEquals(
            json_encode($expectedAssets),
            $this->getResponse()->getBody()
        );
    }

    public function testShouldReturnNoAssetsWhenStatusNotProvided() {
        $this->dispatch('/assets');
        $this->assertResponseStatusCode(200);
        $this->assertEquals(
            json_encode([]),
            $this->getResponse()->getBody()
        );
    }

    public function testShouldReturnAssetsById() {
        $expectedAssetId = '179ad179-19d2-4623-97ad-49a8584d1705';
        $expectedAsset = [
            "id" => $expectedAssetId,
            "status" => [
                "id" => "67247f96-1b1a-48e5-82b4-5277d4438b3c",
                "assetId" => $expectedAssetId,
                "statusType" => "NORMAL",
                "createdAt" => "2010-01-05T17:56:31Z"
            ]
        ];

        $this->dispatch("/assets/{$expectedAssetId}");
        $this->assertResponseStatusCode(200);
        $this->assertEquals(
            json_encode($expectedAsset),
            $this->getResponse()->getBody()
        );
    }

    public function testShouldReturn404ForUnkownAsset() {
        $this->dispatch('/assets/UNKNOWN');
        $this->assertResponseStatusCode(404);
    }

    // public function testShouldReturn500IfDatabaseNotAvailable() {
    //     $this->setApplicationConfig(ArrayUtils::merge(
    //         include __DIR__ . '/../../../../config/application.config.php',
    //         [ 'db' => [] ]
    //     ));

    //     try {
    //         $this->dispatch('/assets');
    //     } catch (Exception $e) {
    //         $this->assertResponseStatusCode(500);
    //     }
    // }
}