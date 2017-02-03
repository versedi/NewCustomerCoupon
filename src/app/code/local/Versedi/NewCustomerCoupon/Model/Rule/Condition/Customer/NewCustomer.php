<?php

class Versedi_NewCustomerCoupon_Model_Rule_Condition_Customer_NewCustomer extends Mage_SalesRule_Model_Rule_Condition_Product_Found
{

    public function __construct() {
        parent::__construct();
        $this->setType('versedi_newcustomercoupon/rule_condition_customer_newCustomer');
    }

    /**
     * Load value options
     *
     * @return Versedi_NewCustomerCoupon_Model_Rule_Condition_Customer_NewCustomer
     */
    public function loadValueOptions() {
        $this->setValueOption(array(
            1 => Mage::helper('versedi_newcustomercoupon')->__('is new and placed no orders.'),
            0 => Mage::helper('versedi_newcustomercoupon')->__('already placed orders in the past.'),
        ));

        return $this;
    }

    public function asHtml() {
        $html = $this->getTypeElement()->getHtml() .
            Mage::helper('salesrule')->__("If customer %s", $this->getValueElement()
                                                                                                                                     ->getHtml());
        if ($this->getId() != '1') {
            $html .= $this->getRemoveLinkHtml();
        }

        return $html;
    }

    public function validate(Varien_Object $object) {
        return (bool)$object->getQuote()->getCustomer()->getIsCustomerNew();
    }
}