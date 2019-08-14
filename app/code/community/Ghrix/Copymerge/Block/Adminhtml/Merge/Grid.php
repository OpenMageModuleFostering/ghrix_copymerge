<?php
class Ghrix_Copymerge_Block_Adminhtml_Merge_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
         
        // Set some defaults for our grid
        $this->setDefaultSort('id');
        $this->setId('ghrix_copymerge_merge_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
     
    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'ghrix_copymerge/merge_collection';
    }
     
    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }
     
    protected function _prepareColumns()
    {
		
		$Category=Mage::getModel('catalog/category')->load($cat);
        $name=$Category->getName();

        // Add the columns that should appear in the grid
        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '10px',
                'index' => 'id'
            )
        );
    
         $this->addColumn('date',
            array(
                'header'=> $this->__('Date'),
                 'width'  => '20px',
                'index' => 'date'
            )
        );
        $this->addColumn('cat1', array(
			'header' => $this->__('Source Category'),
            'index'  => 'cat1',
            'width'  => '20px',
            'renderer'  => 'Ghrix_Copymerge_Block_Adminhtml_Merge_Renderer_Catname'
		));
		$this->addColumn('cat2', array(
			'header' => $this->__('Destination Category'),
            'index'  => 'cat2',
            'width'  => '20px',
            'renderer'  => 'Ghrix_Copymerge_Block_Adminhtml_Merge_Renderer_Catname'
		));
   
        $this->addColumn('actionc',
            array(
                'header'=> $this->__('Action'),
                 'width'  => '20px',
                'index' => 'actionc'
            )
        );
         
         $this->addColumn('delete',
            array(
                'header'    => Mage::helper('catalog')->__('Delete'),
                'width'     => '10px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('catalog')->__('Delete'),
                        'url'     => array(
                            'base'=>'*/*/delete',
                            'params'=>array('store'=>$this->getRequest()->getParam('store'))
                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
            ));

        
         
        return parent::_prepareColumns();
    }
     
    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
