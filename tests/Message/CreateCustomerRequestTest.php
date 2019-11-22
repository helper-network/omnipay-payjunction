<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
	private $request;

	public function setUp(): void
	{
		$this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest());

		$this->request->initialize([
			'CompanyName' => 'Test',
			'CustomField' => 'custom',
			'Email'       => 'test@test.com',
			'identifier'  => 'identify',
			'firstName'   => 'First',
			'jobTitle'    => 'Title',
			'lastName'    => 'Last',
			'middleName'  => 'Middle',
			'phone'       => '5309131122',
			'phone2'      => '5309132233',
			'website'     => 'www.example.com',
		]);

		$this->request->setAppKey('appKey');
		$this->request->setPassword('password');
		$this->request->setUsername('login');

	}

	public function testGetDataReturn()
	{
		$data = $this->request->getData();

		$this->assertEquals('Test', $data['companyName']);
		$this->assertEquals('custom', $data['custom1']);
		$this->assertEquals('test@test.com', $data['email']);
		$this->assertEquals('identify', $data['identifier']);
		$this->assertEquals('First', $data['firstName']);
		$this->assertEquals('Title', $data['jobTitle']);
		$this->assertEquals('Last', $data['lastName']);
		$this->assertEquals('Middle', $data['middleName']);
		$this->assertEquals('5309131122', $data['phone']);
		$this->assertEquals('5309132233', $data['phone2']);
		$this->assertEquals('www.example.com', $data['website']);
	}

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('CreateUserSuccess.txt');
		$response = $this->request->send();

		$this->assertEquals(10079, $response->getCustomerReference());
		$this->assertTrue($response->isSuccessful());
	}

	public function testSendFail()
	{
		$this->setMockHttpResponse('CreateUserFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
	}

}
