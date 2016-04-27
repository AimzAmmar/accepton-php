<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulPromoCodeSearchTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;

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

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/promo_codes")
            ->then()->body(fixture_response("promo_codes_list.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsAListOfPromoCodes()
    {
        $promoCodes = self::$client->promoCodes();

        $this->assertEquals(2, sizeof($promoCodes));
        foreach ($promoCodes as $promoCode) {
            $this->assertEquals("AcceptOn\PromoCode", get_class($promoCode));
        }
    }
}
