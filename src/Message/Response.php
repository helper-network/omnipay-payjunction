<?php

namespace Omnipay\Payjunction\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{

	public function __construct(RequestInterface $request, $data)
	{
		parent::__construct($request, $data);
		$this->data = json_decode($this->data, true);
	}

	/**
	 * Is the transaction successful?
	 *
	 * @return bool
	 */
	public function isSuccessful()
	{
		return !isset($this->data['error']);
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
			return $this->data['error']['message'];
		}
		return null;
	}

	public function getTransactionId()
	{
		return $this->data['transactionId'];
	}


	public function getCustomerReference()
	{
		return $this->data['customerId'];
	}

	public function getAccountReference(){
		return $this->data['vaultId'];
	}


	/**
	 * Get the transaction id from the response.
	 *
	 * Returns transaction id if the request was successful.
	 *
	 * @return int|null
	 */
	public function getTransId()
	{
		if ($this->isSuccessful()) {
			return $this->data['transactionId'];
		}
		return null;
	}
}
