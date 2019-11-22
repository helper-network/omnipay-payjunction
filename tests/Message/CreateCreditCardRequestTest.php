<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;

class CreateCreditCardRequestTest extends TestCase
{
	private $request;

	public function setUp(): void
	{
		$this->request = new CreateCardRequest($this->getHttpClient(), $this->getHttpRequest());


		$card = new CreditCard();
		$card->setNumber('123123123123');
		$card->setExpiryMonth('07');
		$card->setExpiryYear('2020');
		$this->request->initialize([
			'Card' => $card,
			'CustomerId' => '12345'
		]);

		$this->request->setAppKey('appKey');
		$this->request->setPassword('password');
		$this->request->setUsername('login');

	}

	public function testGetDataReturn()
	{
		$data = $this->request->getData();

		$this->assertEquals('123123123123', $data['cardNumber']);
		$this->assertEquals('7', $data['cardExpMonth']);
		$this->assertEquals('2020', $data['cardExpYear']);
	}

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('CreateCardSuccess.txt');
		$response = $this->request->send();

		$this->assertEquals(942, $response->getTransactionReference());
		$this->assertTrue($response->isSuccessful());
	}

	public function testSendFail()
	{
		$this->setMockHttpResponse('CreateCardFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
	}

}
