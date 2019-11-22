<?php

namespace Omnipay\PayJunction\Message;


use Omnipay\Common\CreditCard;

class CreateCardRequest extends AbstractCreateAccountRequest
{
	public function getCard()
	{
		return $this->getParameter('Card');
	}

	public function setCard($value)
	{
		return $this->setParameter('Card', $value);
	}

	/**
	 * @return array|mixed|void
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	public function getData()
	{
		$this->validate('Card');
		/** @var CreditCard $card */
		$card = $this->getCard();

		$data = [
			'cardNumber' => $card->getNumber(),
			'cardExpMonth' => $card->getExpiryMonth(),
			'cardExpYear' => $card->getExpiryYear(),
		];

		return $data;
	}

	protected function getEndpoint()
	{
		return parent::getEndpoint().'/vaults';
	}

	protected function getMethod()
	{
		return 'post';
	}

	/**
	 * @param $data
	 * @throws \Exception
	 */
	protected function createResponse($data)
	{
		return new CreateAccountRequest($this, $data);
	}
}
