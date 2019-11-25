<?php

namespace Omnipay\PayJunction\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{

	protected $code;
	public function __construct(RequestInterface $request, $data)
	{
		parent::__construct($request, $data);
		$this->code = $data->getStatusCode();
		$data = $data->getBody()->getContents();
		$this->data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
	}

	public function getCode()
	{
		return $this->code;
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

	public function getStatus() {
		if($this->data['settlement']['settled']){
			return 'settled';
		}

		return 'submitted';
	}
}
