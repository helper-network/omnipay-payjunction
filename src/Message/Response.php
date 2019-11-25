<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{

	public function __construct(RequestInterface $request, $data)
	{
		parent::__construct($request, $data);
		$this->data = json_decode($this->data, true);
	}

	public function getCode()
	{
		return $this->data['response']['code'];
	}

	/**
	 * Is the transaction successful?
	 *
	 * @return bool
	 */
	public function isSuccessful()
	{
		return !isset($this->data['errors']);
	}

	/**
	 * Get the error message from the response.
	 *
	 * Returns null if the request was successful.
	 *
	 * @return string|null
	 */
	public function getMessage()
	{
		if (!$this->isSuccessful()) {
			return $this->data['errors'][0]['message'];
		}
		return null;
	}

	public function getTransactionId()
	{
		return $this->data['transactionId'];
	}

	public function getTransactionReference(){
		return $this->data['transactionId'];
	}

	public function getAmount()
	{
		return $this->data['amountTotal'];
	}
}
