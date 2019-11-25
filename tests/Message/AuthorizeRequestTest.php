<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
    }

	/**
	 * @throws \Omnipay\PayJunction\Exceptions\NotImplementedException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setAccountId('123123');
		$this->request->setAmount('10.99');
        $data = $this->request->getData();

		$expected = [];
		$expected['status'] = 'HOLD';
		$expected['action'] = 'CHARGE';
		$expected['amountBase'] = 10.99;
		$expected['vaultId'] = 123123;

		$this->assertEquals($expected, $data);
    }

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('AuthorizeSuccess.txt');
		/** @var Response $response */
		$response = $this->request->send();

		$this->assertEquals(3601, $response->getTransactionId());
		$this->assertEquals(5.00, $response->getAmount());
		$this->assertTrue($response->isSuccessful());
	}

	public function testSendFail()
	{
		$this->setMockHttpResponse('AuthorizeFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
		$this->assertEquals(400, $response->getCode());
	}
}
