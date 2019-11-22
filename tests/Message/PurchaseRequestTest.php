<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\PayJunction\Exceptions\NotImplementedException;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

	/**
	 * @throws NotImplementedException
	 * @throws InvalidRequestException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setAccountId('2222333');
		$this->request->setAmount('10.90');
        $data = $this->request->getData();

		$expected = [];
		$expected['status'] = 'CAPTURE';
		$expected['action'] = 'CHARGE';
		$expected['amountBase'] = 10.90;
		$expected['vaultId'] = 2222333;

		$this->assertEquals($expected, $data);
    }

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('PurchaseSuccess.txt');
		/** @var Response $response */
		$response = $this->request->send();

		$this->assertEquals(3601, $response->getTransactionId());
		$this->assertTrue($response->isSuccessful());
	}

	public function testSendFail()
	{
		$this->setMockHttpResponse('PurchaseFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
	}
}
