<?php

namespace Omnipay\PayJunction\Message;


class AuthorizeRequest extends AbstractTransactionRequest
{
	protected function getStatus()
	{
		return 'HOLD';
	}

	protected function getAction()
	{
		return 'CHARGE';
	}
}
