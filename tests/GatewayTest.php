<?php

namespace Omnipay\PayJunction;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\PayJunction\Message\AuthorizeRequest;
use Omnipay\PayJunction\Message\CaptureRequest;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\PayJunction\Message\RefundRequest;
use Omnipay\PayJunction\Message\RetrievePaymentRequest;
use Omnipay\PayJunction\Message\VoidRequest;
use Omnipay\PayJunction\Message\PurchaseRequest;
use Omnipay\PayJunction\Message\CreateCardRequest;
use Omnipay\PayJunction\Message\CreateCustomerRequest;
use Omnipay\PayJunction\Message\CreateBankRequest;

class GatewayTest extends GatewayTestCase {
	/** @var Gateway */
	protected $gateway;

	public function setUp(): void {
		parent::setUp();

		$this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

		$this->gateway->setApiLogin('login');
		$this->gateway->setApiPassword('password');
		$this->gateway->setAppKey('apiKey');
	}

	public function testCreateCustomer(): void {
		$request = $this->gateway->createCustomer([
			'CompanyName' => 'CompanyName Data',
			'CustomField' => 'CustomField Data',
			'Email'       => 'Email Data',
			'Identifier'  => 'Identifier Data',
			'FirstName'   => 'FirstName Data',
			'JobTitle'    => 'JobTitle Data',
			'LastName'    => 'LastName Data',
			'MiddleName'  => 'MiddleName Data',
			'Phone'       => 'Phone Data',
			'Phone2'      => 'Phone2 Data',
			'Website'     => 'Website Data',
		]);

		$this->assertInstanceOf(CreateCustomerRequest::class, $request);
		$this->assertSame('CompanyName Data', $request->getCompanyName());
		$this->assertSame('CustomField Data', $request->getCustomField());
		$this->assertSame('Email Data', $request->getEmail());
		$this->assertSame('Identifier Data', $request->getIdentifier());
		$this->assertSame('FirstName Data', $request->getFirstName());
		$this->assertSame('JobTitle Data', $request->getJobTitle());
		$this->assertSame('LastName Data', $request->getLastName());
		$this->assertSame('MiddleName Data', $request->getMiddleName());
		$this->assertSame('Phone Data', $request->getPhone());
		$this->assertSame('Phone2 Data', $request->getPhone2());
		$this->assertSame('Website Data', $request->getWebsite());
	}

	public function testCreateBank(): void {
		$request = $this->gateway->createBank([
			'CustomerId'    => '123456',
			'RoutingNumber' => '131111114',
			'AccountNumber' => '751111111',
			'AccountType'   => 'checking',
		]);

		$this->assertInstanceOf(CreateBankRequest::class, $request);
		$this->assertSame('123456', $request->getCustomerId());
		$this->assertSame('131111114', $request->getRoutingNumber());
		$this->assertSame('751111111', $request->getAccountNumber());
		$this->assertSame('checking', $request->getAccountType());
	}

	public function testCreateCard(): void {
		$card = new CreditCard([
			'number'      => '5454545454545454',
			'expiryMonth' => '13',
			'expiryYear'  => '2021',
		]);

		$request = $this->gateway->createCard([
			'card'       => $card,
			'CustomerId' => '012345'
		]);

		$this->assertInstanceOf(CreateCardRequest::class, $request);
		$this->assertSame('012345', $request->getCustomerId());
		$this->assertSame('5454545454545454', $request->getCard()->getNumber());
		$this->assertEquals('13', $request->getCard()->getExpiryMonth());
		$this->assertEquals('2021', $request->getCard()->getExpiryYear());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testAuthorize(): void {
		$request = $this->gateway->authorize([
			'AccountId' => '789123',
			'Amount'    => '12.73',
		]);

		$this->assertInstanceOf(AuthorizeRequest::class, $request);
		$this->assertSame('789123', $request->getAccountId());
		$this->assertSame('12.73', $request->getAmount());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testCapture(): void{
		$request = $this->gateway->capture([
			'AccountId' => '789123',
			'Amount'    => '5.23',
		]);

		$this->assertInstanceOf(CaptureRequest::class, $request);
		$this->assertSame('789123', $request->getAccountId());
		$this->assertSame('5.23', $request->getAmount());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testPurchase(): void {
		$request = $this->gateway->purchase([
			'AccountId' => '789123',
			'Amount'    => '50.70',
		]);

		$this->assertInstanceOf(PurchaseRequest::class, $request);
		$this->assertSame('789123', $request->getAccountId());
		$this->assertSame('50.70', $request->getAmount());
	}

	public function testVoid(): void {
		$request = $this->gateway->void([
			'TransactionId' => 467890,
		]);

		$this->assertInstanceOf(VoidRequest::class, $request);
		$this->assertSame(467890, $request->getTransactionId());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testRefund(): void {
		$request = $this->gateway->refund([
			'TransactionId' => 467890,
			'Amount' => 10
		]);

		$this->assertInstanceOf(RefundRequest::class, $request);
		$this->assertSame(467890, $request->getTransactionId());
		$this->assertEquals(10, $request->getAmount());
	}

	public function testRetrievePayment(): void {
		$request = $this->gateway->retrievePayment([
			'TransactionId' => 467890,
		]);

		$this->assertInstanceOf(RetrievePaymentRequest::class, $request);
		$this->assertSame(467890, $request->getTransactionId());
	}
}
