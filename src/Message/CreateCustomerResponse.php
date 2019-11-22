<?php

namespace Omnipay\PayJunction\Message;

class CreateCustomerResponse extends Response
{
	public function getTransactionReference() {
		return $this->data['customerId'];
	}
}
