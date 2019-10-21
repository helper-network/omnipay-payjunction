<?php

namespace Omnipay\PayJunction;

use Omnipay\Common\AbstractGateway;
use Omnipay\PayJunction\Message\AuthorizeRequest;
use Omnipay\PayJunction\Message\CaptureRequest;
use Omnipay\PayJunction\Message\CreateBankAccountRequest;
use Omnipay\PayJunction\Message\CreateCardRequest;
use Omnipay\PayJunction\Message\CreateCustomerRequest;
use Omnipay\PayJunction\Message\PurchaseRequest;
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
			'apiLogin'    => '',
			'apiPassword' => '',
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

	public function getApiLogin()
	{
		return $this->getParameter('apiLogin');
	}

	public function setApiLogin($value)
	{
		return $this->setParameter('apiLogin', $value);
	}

	public function getApiPassword()
	{
		return $this->getParameter('apiPassword');
	}

	public function setApiPassword($value)
	{
		return $this->setParameter('apiPassword', $value);
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
		return $this->createRequest(PurchaseRequest::class, $parameters);
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

	public function createBankAccount(array $parameters = [])
	{
		return $this->createRequest(CreateBankAccountRequest::class, $parameters);
	}

}
