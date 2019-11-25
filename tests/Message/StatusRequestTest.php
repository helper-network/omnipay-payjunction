<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\PayJunction\Exceptions\NotImplementedException;
use Omnipay\Tests\TestCase;

class StatusRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new StatusRequest($this->getHttpClient(), $this->getHttpRequest());
    }

	/**
	 * @throws NotImplementedException
	 * @throws InvalidRequestException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setTransactionId('222333');
        $data = $this->request->getData();

		$this->assertEquals([], $data);
    }

	public function testSendSettled()
	{
		$this->setMockHttpResponse('StatusSettled.txt');
		/** @var Response $response */
		$response = $this->request->send();

		$this->assertEquals('settled', $response->getStatus());
	}

	public function testSendSubmitted()
	{
		$this->setMockHttpResponse('StatusSubmitted.txt');
		/** @var Response $response */
		$response = $this->request->send();

		$this->assertEquals('submitted', $response->getStatus());
	}
}
