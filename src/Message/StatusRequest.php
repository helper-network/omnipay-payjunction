<?php

namespace Omnipay\PayJunction\Message;


class StatusRequest extends CaptureRequest
{
	public function getData() {
		return [];
	}

	protected function getEndpoint()
	{
		return parent::getEndpoint() . '/' . $this->getTransactionId();
	}
}
