<?php

namespace Omnipay\PayJunction\Message;

class CreateAccountRequest extends Response
{
	public function getTransactionReference() {
		return $this->data['vaultId'];
	}
}
