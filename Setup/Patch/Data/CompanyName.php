<?php

namespace Pledg\PledgPaymentGateway\Setup\Patch\Data;

use Exception;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Model\ResourceModel\Attribute as AttributeResource;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

class CompanyName implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetup
     */
    private $customerSetup;

    /**
     * @var AttributeResource
     */
    private $attributeResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory,
        EavSetupFactory $eavSetupFactory,
        AttributeResource $attributeResource,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetup = $customerSetupFactory->create(['setup' => $moduleDataSetup]);
        $this->attributeResource = $attributeResource;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        // return; // Use only to add custom company field name to new Magento dev instance

        // Start setup
        $this->moduleDataSetup->getConnection()->startSetup();

        try {
            // Add customer attribute with settings
            $this->customerSetup->addAttribute(
                CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                'pledg_company_name',
                [
                    'label' => 'Pledg company name',
                    'required' => 0,
                    'position' => 100,
                    'system' => 0,
                    'user_defined' => 1,
                    'is_used_in_grid' => 1,
                    'is_visible_in_grid' => 1,
                    'is_filterable_in_grid' => 1,
                    'is_searchable_in_grid' => 1,
                ]
            );

            // Add attribute to default attribute set and group
            $this->customerSetup->addAttributeToSet(
                CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
                null,
                'pledg_company_name'
            );

            // Get the newly created attribute's model
            $attribute = $this->customerSetup->getEavConfig()
                ->getAttribute(CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER, 'pledg_company_name');

            // Make attribute visible in Admin customer form
            $attribute->setData('used_in_forms', [
                'adminhtml_customer'
            ]);

            // Save attribute using its resource model
            $this->attributeResource->save($attribute);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        // End setup
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '1.0.0';
    }
}
