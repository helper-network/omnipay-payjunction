<?php

namespace Omnipay\PayJunction\Message;


class VoidRequest extends CaptureRequest
{
	public function getStatus()
	{
		return 'VOID';
	}
}
