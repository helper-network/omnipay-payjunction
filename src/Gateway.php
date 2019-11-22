<?php

namespace Omnipay\PayJunction;

use Omnipay\Common\AbstractGateway;
use Omnipay\PayJunction\Message\AuthorizeRequest;
use Omnipay\PayJunction\Message\CaptureRequest;
use Omnipay\PayJunction\Message\CreateBankRequest;
use Omnipay\PayJunction\Message\CreateCardRequest;
use Omnipay\PayJunction\Message\CreateCustomerRequest;
use Omnipay\PayJunction\Message\PurchaseRequest;
use Omnipay\PayJunction\Message\RefundRequest;
use Omnipay\PayJunction\Message\RetrievePaymentRequest;
use Omnipay\PayJunction\Message\VoidRequest;

/**
 * iPay8 Gateway Driver for Omnipay
 *
 * This driver is based on
 * Online Payment Switching Gateway Technical Specification Version 1.6.1
 * @link https://drive.google.com/file/d/0B4YUBYSgSzmAbGpjUXMyMWx6S2s/view?usp=sharing
 */
class Gateway extends AbstractGateway {
	public function getName()
	{
		return 'PayJunction';
	}

	public function getDefaultParameters()
	{
		return [
			'appKey'      => '',
			'username'    => '',
			'password' => '',
		];
	}

	public function getAppKey()
	{
		return $this->getParameter('appKey');
	}

	public function setAppKey($value)
	{
		return $this->setParameter('appKey', $value);
	}

	public function getUsername()
	{
		return $this->getParameter('username');
	}

	public function setUsername($value)
	{
		return $this->setParameter('username', $value);
	}

	public function getPassword()
	{
		return $this->getParameter('password');
	}

	public function setPassword($value)
	{
		return $this->setParameter('password', $value);
	}

	public function authorize(array $parameters = [])
	{
		return $this->createRequest(AuthorizeRequest::class, $parameters);
	}

	public function purchase(array $parameters = [])
	{
		return $this->createRequest(PurchaseRequest::class, $parameters);
	}

	public function void(array $parameters = [])
	{
		return $this->createRequest(VoidRequest::class, $parameters);
	}

	public function refund(array $parameters = [])
	{
		return $this->createRequest(RefundRequest::class, $parameters);
	}

	public function capture(array $parameters = [])
	{
		return $this->createRequest(CaptureRequest::class, $parameters);
	}

	public function createCustomer(array $parameters = []){
		return $this->createRequest(CreateCustomerRequest::class, $parameters);
	}

	public function createCard(array $parameters = [])
	{
		return $this->createRequest(CreateCardRequest::class, $parameters);
	}

	public function createBank(array $parameters = [])
	{
		return $this->createRequest(CreateBankRequest::class, $parameters);
	}

	public function retrievePayment(array $parameters = []) {
		return $this->createRequest(RetrievePaymentRequest::class, $parameters);

	}

}
