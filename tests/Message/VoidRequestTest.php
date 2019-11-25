<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\PayJunction\Exceptions\NotImplementedException;
use Omnipay\Tests\TestCase;

class VoidRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new VoidRequest($this->getHttpClient(), $this->getHttpRequest());
    }

	/**
	 * @throws NotImplementedException
	 * @throws InvalidRequestException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setTransactionId('222333');
		$this->request->setAmount('4.10');
        $data = $this->request->getData();

		$expected = [];
		$expected['status'] = 'VOID';
		$expected['action'] = 'CHARGE';
		$expected['amountBase'] = '4.10';
		$expected['transactionId'] = 222333;

		$this->assertEquals($expected, $data);
    }

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('VoidSuccess.txt');
		/** @var Response $response */
		$response = $this->request->send();

		$this->assertEquals(3601, $response->getTransactionId());
		$this->assertEquals(5.00, $response->getAmount());
		$this->assertTrue($response->isSuccessful());
	}

	public function testSendFail()
	{
		$this->setMockHttpResponse('VoidFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
	}
}
