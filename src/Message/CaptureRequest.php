<?php

namespace Omnipay\PayJunction\Message;


class CaptureRequest extends AbstractTransactionRequest
{
	public function getData()
	{
		$data['transactionId'] = $this->getTransactionId();
		$data['status'] = $this->getStatus();
		$data['action'] = $this->getAction();
		$data['amountBase'] = $this->getAmount();

		return $data;
	}
}
