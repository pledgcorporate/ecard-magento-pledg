<?php

namespace Pledg\PledgPaymentGateway\Model\Config\Source;

use Magento\Customer\Model\ResourceModel\Group\Collection as CustomerGroup;
use Magento\Framework\Data\OptionSourceInterface;

class AllowedGroups
{
    protected $customerGroup;

    public function __construct(CustomerGroup $customerGroup)
    {
        $this->customerGroup = $customerGroup;
    }

    public function toOptionArray()
    {
        return $this->customerGroup->toOptionArray();
    }
}