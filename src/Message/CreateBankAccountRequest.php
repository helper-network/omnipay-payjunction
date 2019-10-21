<?php

namespace Omnipay\PayJunction\Message;


class CreateBankAccountRequest extends AbstractCreateAccountRequest
{
	public function getRoutingNumber()
	{
		return $this->getParameter('RoutingNumber');
	}

	public function setRoutingNumber($value)
	{
		return $this->setParameter('RoutingNumber', $value);
	}

	public function getAccountNumber()
	{
		return $this->getParameter('AccountNumber');
	}

	public function setAccountNumber($value)
	{
		return $this->setParameter('AccountNumber', $value);
	}

	public function getAccountType()
	{
		return $this->getParameter('AccountType');
	}

	public function setAccountType($value)
	{
		return $this->setParameter('AccountType', $value);
	}

	/**
	 * @return mixed|void
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 * @throws \Omnipay\PayJunction\Exceptions\NotImplementedException
	 */
	public function getData()
	{
		$data['achRoutingNumber'] = $this->getRoutingNumber();
		$data['achAccountNumber'] = $this->getAccountNumber();
		$data['achAccountType']   = $this->getAccountType();
		$data['achType']          = 'PPD';

		return $data;
	}
}
