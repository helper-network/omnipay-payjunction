<?php

namespace Omnipay\PayJunction\Message;


class RefundRequest extends CaptureRequest
{

	protected function getAction()
	{
		return 'REFUND';
	}
}
