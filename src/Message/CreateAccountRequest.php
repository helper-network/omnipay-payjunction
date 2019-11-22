<?php

namespace Omnipay\Payjunction\Message;

class CreateAccountRequest extends Response
{
	public function getTransactionReference() {
		return $this->data['vaultId'];
	}
}
