<?php

namespace Omnipay\PayJunction\Message;


use Omnipay\PayJunction\Exceptions\NotImplementedException;

class AbstractTransactionRequest extends AbstractRequest
{

	public function getAccountId()
	{
		return $this->getParameter('AccountId');
	}

	public function setAccountId($value)
	{
		return $this->setParameter('AccountId', $value);
	}

	/**
	 * @return mixed|void
	 * @throws NotImplementedException
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	public function getData()
	{
		$data['vaultId'] = $this->getAccountId();
		$data['status'] = $this->getStatus();
		$data['action'] = $this->getAction();
		$data['amountBase'] = $this->getAmount();

		return $data;
	}

	protected function getEndpoint()
	{
		$urlBase = $this->getUrlBase();
		return $urlBase . '/transaction';
	}

	protected function getStatus()
	{
		return 'CAPTURE';
	}

	protected function getAction()
	{
		return 'CHARGE';
	}
}
