<?php
namespace Omnipay\PayJunction\Exceptions;

class NotImplementedException extends \Exception
{
	public function __construct()
	{
		parent::__construct($message = '', $code = 0);
	}
}
