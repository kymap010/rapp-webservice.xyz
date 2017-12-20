<?php
/**
 * The contents of this file was generated using the WSDLs as provided by eBay.
 *
 * DO NOT EDIT THIS FILE!
 */

namespace DTS\eBaySDK\Trading\Types;

/**
 *
 * @property \DTS\eBaySDK\Trading\Types\StoreThemeArrayType $BasicThemeArray
 * @property \DTS\eBaySDK\Trading\Types\StoreThemeArrayType $AdvancedThemeArray
 * @property \DTS\eBaySDK\Trading\Types\StoreLogoArrayType $LogoArray
 * @property \DTS\eBaySDK\Trading\Types\StoreSubscriptionArrayType $SubscriptionArray
 * @property integer $MaxCategories
 * @property integer $MaxCategoryLevels
 */
class GetStoreOptionsResponseType extends \DTS\eBaySDK\Trading\Types\AbstractResponseType
{
    /**
     * @var array Properties belonging to objects of this class.
     */
    private static $propertyTypes = [
        'BasicThemeArray' => [
            'type' => 'DTS\eBaySDK\Trading\Types\StoreThemeArrayType',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'BasicThemeArray'
        ],
        'AdvancedThemeArray' => [
            'type' => 'DTS\eBaySDK\Trading\Types\StoreThemeArrayType',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'AdvancedThemeArray'
        ],
        'LogoArray' => [
            'type' => 'DTS\eBaySDK\Trading\Types\StoreLogoArrayType',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'LogoArray'
        ],
        'SubscriptionArray' => [
            'type' => 'DTS\eBaySDK\Trading\Types\StoreSubscriptionArrayType',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'SubscriptionArray'
        ],
        'MaxCategories' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'MaxCategories'
        ],
        'MaxCategoryLevels' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'MaxCategoryLevels'
        ]
    ];

    /**
     * @param array $values Optional properties and values to assign to the object.
     */
    public function __construct(array $values = [])
    {
        list($parentValues, $childValues) = self::getParentValues(self::$propertyTypes, $values);

        parent::__construct($parentValues);

        if (!array_key_exists(__CLASS__, self::$properties)) {
            self::$properties[__CLASS__] = array_merge(self::$properties[get_parent_class()], self::$propertyTypes);
        }

        if (!array_key_exists(__CLASS__, self::$xmlNamespaces)) {
            self::$xmlNamespaces[__CLASS__] = 'xmlns="urn:ebay:apis:eBLBaseComponents"';
        }

        $this->setValues(__CLASS__, $childValues);
    }
}