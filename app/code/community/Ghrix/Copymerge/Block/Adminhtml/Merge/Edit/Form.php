<?php
class Ghrix_Copymerge_Block_Adminhtml_Merge_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {  
        parent::__construct();
     
        $this->setId('ghrix_copymerge_merge_form');
        $this->setTitle($this->__('Category Handler Information'));
    }  
     
    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {  
        $model = Mage::registry('ghrix_copymerge');
     
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));
     
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('checkout')->__('Category Handler Information'),
            'class'     => 'fieldset-wide',
        ));
     
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }  
     
		$fieldset->addField('cat1', 'select',
		array(
			'name'     => 'cat1',
			'label'    => 'Source Category',
			'title'    => 'Source Category',
			'required'  => true,
			'container_id'     =>  'custom_source',
			'values'   => Mage::getModel("ghrix_copymerge/merge")->toOptionArray()
			
		));

		$fieldset->addField('cat2', 'select',
		array(
			'name'     => 'cat2',
			'label'    => 'Destination Category',
			'title'    => 'Destination Category',
			'required'  => true,
			'container_id'     =>  'custom_destination',
			'values'   => Mage::getModel("ghrix_copymerge/merge")->toOptionArray()
		));
		
		$fieldset->addField('actionc', 'radios', array(
          'label'     => Mage::helper('checkout')->__('Action'),
          'name'      => 'actionc',
          'onclick' => "",
          'onchange' => "",
          //'required'  => true,
          'values' => array(
                            array('value'=>'Copy','label'=>'Copy Products And Categories'),
                            array('value'=>'Move','label'=>'Move Products And Categories'),
                       ),
          'disabled' => false,
          'readonly' => false,
          'container_id'     =>  'custom_action',
          //~ 'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
       

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
     
        return parent::_prepareForm();
    }  
}
