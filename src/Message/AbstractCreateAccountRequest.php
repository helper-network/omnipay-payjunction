<?php

namespace Omnipay\PayJunction\Message;


use Omnipay\PayJunction\Exceptions\NotImplementedException;

class AbstractCreateAccountRequest extends AbstractRequest
{
	public function getCustomerId()
	{
		return $this->getParameter('CustomerId');
	}

	public function setCustomerId($value)
	{
		return $this->setParameter('CustomerId', $value);
	}


	/**
	 * @return string|void
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	protected function getEndpoint()
	{
		$this->validate('CustomerId');

		$urlBase = $this->getUrlBase();
		return $urlBase . '/customers/'.$this->getCustomerId();
	}

	protected function getMethod()
	{
		return 'post';
	}

	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 */
	public function getData()
	{
		throw new NotImplementedException();
	}
}
