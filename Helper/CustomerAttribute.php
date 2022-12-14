<?php

namespace Pledg\PledgPaymentGateway\Helper;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\DataObject;

class CustomerAttribute
{
    public static function getCustomerAttributeValue(CustomerInterface $customer, string $attributeCode): ?string
    {
        $value = null;
        if ($attribute = $customer->getCustomAttribute($attributeCode)) {
            $value = $attribute->getValue();
        }

        if ((null === $value)
            && ($customer instanceof DataObject)
            && $customer->hasData($attributeCode)
        ) {
            $value = $customer->getData($attributeCode);
        }

        return $value;
    }
}
