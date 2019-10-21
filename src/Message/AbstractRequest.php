<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\PayJunction\Exceptions\NotImplementedException;

abstract class AbstractRequest extends BaseAbstractRequest
{
	protected $productionEndpoint = 'https://api.payjunction.com';
	protected $sandboxEndpoint = 'https://api.payjunctionlabs.com';

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

	protected function getUrlBase()
	{
		return $this->getTestMode() ? $this->sandboxEndpoint : $this->productionEndpoint;
	}

	protected function getMethod(){
		return 'post';
	}

	/**
	 *
	 * @throws NotImplementedException
	 */
	protected function getEndpoint()
	{
		throw new NotImplementedException();
	}

	/**
	 * @param mixed $data
	 * @return \Omnipay\Common\Message\ResponseInterface|void
	 * @throws \Psr\Http\Client\Exception\NetworkException
	 * @throws \Psr\Http\Client\Exception\RequestException
	 * @throws \Exception
	 */
	public function sendData($data)
	{
		$response = $this->httpClient
			->request(
				$this->getMethod(),
				$this->getEndpoint(),
				[
					'Content-Type'         => 'application/x-www-form-urlencoded',
					'Authorization'        => 'Basic ' . base64_encode($this->getApiLogin() . ':' . $this->getApiPassword()),
					'X-PJ-Application-Key' => $this->getAppKey(),
				],
				json_encode($data)
			)
			->getBody()
			->getContents();

		return $this->createResponse($response);
	}

	/**
	 * @param $data
	 * @throws \Exception
	 */
	protected function createResponse($data)
	{
		return new Response($this, $data);
	}
}
