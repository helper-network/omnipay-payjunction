<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;

class CreateBankAccountRequestTest extends TestCase
{
	private $request;

	public function setUp()
	{
		$this->request = new CreateBankAccountRequest($this->getHttpClient(), $this->getHttpRequest());

		$this->request->initialize([
			'CustomerId'    => '12345',
			'RoutingNumber' => '1111111',
			'AccountNumber' => '2222222',
			'AccountType'   => 'Checking',
		]);

		$this->request->setAppKey('appKey');
		$this->request->setApiPassword('password');
		$this->request->setApiLogin('login');

	}

	public function testGetDataReturn()
	{
		$data = $this->request->getData();

		$this->assertEquals('1111111', $data['achRoutingNumber']);
		$this->assertEquals('2222222', $data['achAccountNumber']);
		$this->assertEquals('Checking', $data['achAccountType']);
		$this->assertEquals('PPD', $data['achType']);
	}

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('CreateCardSuccess.txt');
		$response = $this->request->send();

		$this->assertEquals(916, $response->getCustomerReference());
		$this->assertEquals(942, $response->getAccountReference());
		$this->assertTrue($response->isSuccessful());
	}

	public function testSendFail()
	{
		$this->setMockHttpResponse('CreateCardFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
	}

}
