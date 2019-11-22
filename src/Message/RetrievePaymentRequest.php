<?php

namespace Omnipay\PayJunction\Message;


class RetrievePaymentRequest extends AbstractTransactionRequest
{

	protected function getMethod() {
		return 'GET';
	}

	protected function getEndpoint() {
		return parent::getEndpoint().'/'.$this->getTransactionId();
	}
}
