<?php
namespace IdeaSoft\PayU\Parameter\Model;

/**
 * Class DeliveryAddress
 * @package IdeaSoft\PayU\Parameter\Model
 */
class DeliveryAddress extends AbstractAddress
{
    /**
     * @var string
     */
    private $company;

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }
}