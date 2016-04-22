<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulPromoCodeUpdateTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $params;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass("8082", "localhost");
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();

        self::$client = new Client("skey_123", "test");
        self::$params = array(
            "name" => "20OFF",
            "promo_type" => "amount",
            "value" => 1000,
        );

        $this->http->mock
            ->when()->methodIs("PUT")->pathIs("/v1/promo_codes/10OFF")
            ->then()->body(fixture_response("promo_code.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function testReturnsAPromoCode()
    {
        $promoCode = self::$client->updatePromoCode("10OFF", self::$params);

        $this->assertNotNull($promoCode->createdAt);
        $this->assertEquals("20OFF", $promoCode->name);
        $this->assertEquals("amount", $promoCode->promoType);
        $this->assertEquals(2000, $promoCode->value);
    }
}
