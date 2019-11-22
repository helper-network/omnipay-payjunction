<?php

namespace Omnipay\PayJunction\Message;


class CreateCustomerRequest extends AbstractRequest
{
	public function setCompanyName($value)
	{
		return $this->setParameter('CompanyName', $value);
	}

	public function getCompanyName()
	{
		return $this->getParameter('CompanyName');
	}

	public function setCustomField($value)
	{
		return $this->setParameter('CustomField', $value);
	}

	public function getCustomField()
	{
		return $this->getParameter('CustomField');
	}

	public function setEmail($value)
	{
		return $this->setParameter('Email', $value);
	}

	public function getEmail()
	{
		return $this->getParameter('Email');
	}

	public function setIdentifier($value)
	{
		return $this->setParameter('Identifier', $value);
	}

	public function getIdentifier()
	{
		return $this->getParameter('Identifier');
	}

	public function setFirstName($value)
	{
		return $this->setParameter('FirstName', $value);
	}

	public function getFirstName()
	{
		return $this->getParameter('FirstName');
	}

	public function setJobTitle($value)
	{
		return $this->setParameter('JobTitle', $value);
	}

	public function getJobTitle()
	{
		return $this->getParameter('JobTitle');
	}

	public function setLastName($value)
	{
		return $this->setParameter('LastName', $value);
	}

	public function getLastName()
	{
		return $this->getParameter('LastName');
	}

	public function setMiddleName($value)
	{
		return $this->setParameter('MiddleName', $value);
	}

	public function getMiddleName()
	{
		return $this->getParameter('MiddleName');
	}

	public function setPhone($value)
	{
		return $this->setParameter('Phone', $value);
	}

	public function getPhone()
	{
		return $this->getParameter('Phone');
	}

	public function setPhone2($value)
	{
		return $this->setParameter('Phone2', $value);
	}

	public function getPhone2()
	{
		return $this->getParameter('Phone2');
	}

	public function setWebsite($value)
	{
		return $this->setParameter('Website', $value);
	}

	public function getWebsite()
	{
		return $this->getParameter('Website');
	}

	public function getData()
	{
		$data = [
			'companyName' => $this->getCompanyName(),
			'custom1' => $this->getCustomField(),
			'email' => $this->getEmail(),
			'identifier' => $this->getIdentifier(),
			'firstName' => $this->getFirstName(),
			'jobTitle' => $this->getJobTitle(),
			'lastName' => $this->getLastName(),
			'middleName' => $this->getMiddleName(),
			'phone' => $this->getPhone(),
			'phone2' => $this->getPhone2(),
			'website' => $this->getWebsite()
		];

		return $data;
	}

	protected function getEndpoint()
	{
		$urlBase = $this->getUrlBase();
		return $urlBase . '/customers';
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
		return new CreateCustomerResponse($this, $data);
	}
}
