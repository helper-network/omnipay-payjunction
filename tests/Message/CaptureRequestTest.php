<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\PayJunction\Exceptions\NotImplementedException;
use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest());
    }

	/**
	 * @throws NotImplementedException
	 * @throws InvalidRequestException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setTransactionId('1112222');
		$this->request->setAmount('4.59');
        $data = $this->request->getData();

		$expected = [];
		$expected['status'] = 'CAPTURE';
		$expected['action'] = 'CHARGE';
		$expected['amountBase'] = '4.59';
		$expected['transactionId'] = 1112222;

		$this->assertEquals($expected, $data);
    }

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('AuthorizeSuccess.txt');
		/** @var Response $response */
		$response = $this->request->send();

		$this->assertEquals(3601, $response->getTransactionId());
		$this->assertTrue($response->isSuccessful());
	}

	public function testSendFail()
	{
		$this->setMockHttpResponse('AuthorizeFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
	}
}
