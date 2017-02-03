<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();
$attribute = array(
    'attribute_model' => null,
    'backend'         => null,
    'type'            => 'int',
    'table'           => null,
    'frontend'        => null,
    'input'           => 'select',
    'label'           => 'New customer (placed no orders yet)',
    'frontend_class'  => '',
    'source'          => 'eav/entity_attribute_source_boolean',
    'required'        => '0',
    'is_user_defined' => '1',
    'default'         => '0',
    'unique'          => '0',
    'note'            => null,
    'visible'         => '0',
    'input_filter'    => null,
    'multiline_count' => '1',
    'validate_rules'  => null,
    'system'          => '0',
    'data_model'      => null,
    'used_in_forms'   => array('adminhtml_customer'),
);
$entityTypeId = $installer->getEntityTypeId('customer');
$installer->addAttribute($entityTypeId, 'is_customer_new', $attribute);

//Now we can add it to form and set it's sort order.
$forms = array('adminhtml_customer');
$attr = Mage::getSingleton('eav/config')->getAttribute($entityTypeId, 'is_customer_new');
$attr->setUsedInForms($forms);
$attr->setSortOrder(999);
try {
    $attr->save();
} catch (Exception $e) {
    Mage::logException($e);
}
$installer->endSetup();