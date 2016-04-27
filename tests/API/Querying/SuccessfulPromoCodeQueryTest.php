<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulPromoCodeQueryTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $promoCodeId;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8082', 'localhost');
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();

        self::$client = new Client("skey_123", "test");
        self::$promoCodeId = "20OFF";

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/promo_codes/" . self::$promoCodeId)
            ->then()->body(fixture_response("promo_code.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsApromoCode()
    {
        $promoCode = self::$client->promoCode(self::$promoCodeId);

        $this->assertEquals("AcceptOn\PromoCode", get_class($promoCode));
        $this->assertEquals("20OFF", $promoCode->name);
        $this->assertEquals("amount", $promoCode->promoType);
        $this->assertEquals(2000, $promoCode->value);
    }
}
