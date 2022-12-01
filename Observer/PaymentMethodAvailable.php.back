<?php

namespace Pledg\PledgPaymentGateway\Observer;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Payment\Model\Method\Adapter;
use Magento\Quote\Api\Data\CartInterface;
use Pledg\PledgPaymentGateway\Model\Ui\ConfigProvider;

class PaymentMethodAvailable implements ObserverInterface
{
    /**
     * CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * Session
     */
    private $customerSession;

    /**
     * ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        CustomerRepositoryInterface $customerRepository, 
        Session $customerSession, 
        ScopeConfigInterface $scopeConfig
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * payment_method_is_active event handler.
     */
    public function execute(Observer $observer)
    {
        /** @var CartInterface $quote */
        $quote = $observer->getData('quote');
        if ($quote === null) {
            return;
        }

        /** @var DataObject $checkResult */
        $checkResult = $observer->getData('result');
        /** @var Adapter $adapter */
        $adapter = $observer->getData('method_instance');

        if (!in_array($adapter->getCode(), ConfigProvider::getPaymentMethodCodes())) {
            return;
        }

        if (!$adapter->getConfigData('active', $quote->getStoreId())) {
            $checkResult->setData('is_available', false);
            return;
        }
    
        $gatewayIsB2B = $adapter->getConfigData('is_b2b', $quote->getStoreId());
        
        if ($this->customerSession->isLoggedIn()) {
            $customer = $this->customerRepository->getById($this->customerSession->getCustomer()->getId());
        
            // Handling groups
            if ($allowedGroupsConfig = $adapter->getConfigData('allowed_groups', $quote->getStoreId())) {
                $allowedGroups = explode(',', $allowedGroupsConfig);
                $customerGroup = $this->customerSession->getCustomerGroupId();

                if (($customerGroup === $allowedGroups) || !in_array($customerGroup, $allowedGroups)) {
                    $checkResult->setData('is_available', false); // Customer does not belong to this gateway groups
                    return;
                }
            }

            // Handling B2B
            $siretCustomFieldName = $this->scopeConfig->getValue('pledg_gateway/payment/siret_custom_field_name') 
                ?: 'siret_number';
            $companyCustomFieldName = $this->scopeConfig->getValue('pledg_gateway/payment/company_custom_field_name') 
                ?: 'company_name';
            
            $siretAttribute = $customer->getCustomAttribute($siretCustomFieldName);
            $companyNameAttribute = $customer->getCustomAttribute($companyCustomFieldName);
            
            $customerIsB2B = $siretAttribute && $companyNameAttribute;

            if ($gatewayIsB2B && !$customerIsB2B) { // Do not display B2B gateways for B2C customers
                $checkResult->setData('is_available', false);
                return;
            } elseif (!$gatewayIsB2B && $customerIsB2B) { // Do not display B2C gateways for B2B customers
                $checkResult->setData('is_available', false);
                return;
            }
        } else {
            if ($gatewayIsB2B) { // Customer not logged : only display B2C gateways
                $checkResult->setData('is_available', false);
                return;
            }
        }
    }
}
