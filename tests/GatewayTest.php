<?php

namespace Omnipay\PayJunction;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    /** @var array */
    private $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setApiLogin('login');
		$this->gateway->setApiPassword('password');
		$this->gateway->setAppKey('apiKey');
    }

    public function testCreateCard(){
		$card = new CreditCard([
			'number' => '5454545454545454',
			'expiryMonth' => '13',
			'expiryYear' => '2021',
		]);
		$response = $this->gateway->createCard(
			[
				'card' => $card,
				]
		);
		$card = $response->getCard();
		$this->assertEquals('5454545454545454', $card->getNumber());
		$this->assertEquals('13', $card->getExpiryMonth());
		$this->assertEquals('2021', $card->getExpiryYear());
	}

    public function testPurchase()
    {
        $response = $this->gateway->purchase()->setAccountId('123123')->send();

        $this->assertTrue($response->isSuccessful());
    }
}
