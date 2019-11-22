<?php

namespace Omnipay\Payjunction\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CreateCustomerResponse extends Response
{
	public function getTransactionReference() {
		return $this->data['customerId'];
	}
}
