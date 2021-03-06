<?php
/**
 * The contents of this file was generated using the WSDLs as provided by eBay.
 *
 * DO NOT EDIT THIS FILE!
 */

namespace DTS\eBaySDK\BusinessPoliciesManagement\Types;

/**
 *
 * @property \DTS\eBaySDK\BusinessPoliciesManagement\Types\PositiveInteger $id
 * @property string $version
 * @property string $contentType
 * @property string $value
 */
class ExtensionType extends \DTS\eBaySDK\Types\BaseType
{
    /**
     * @var array Properties belonging to objects of this class.
     */
    private static $propertyTypes = [
        'id' => [
            'type' => 'DTS\eBaySDK\BusinessPoliciesManagement\Types\PositiveInteger',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'id'
        ],
        'version' => [
            'type' => 'string',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'version'
        ],
        'contentType' => [
            'type' => 'string',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'contentType'
        ],
        'value' => [
            'type' => 'string',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'value'
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
            self::$xmlNamespaces[__CLASS__] = 'xmlns="http://www.ebay.com/marketplace/selling/v1/services"';
        }

        $this->setValues(__CLASS__, $childValues);
    }
}
