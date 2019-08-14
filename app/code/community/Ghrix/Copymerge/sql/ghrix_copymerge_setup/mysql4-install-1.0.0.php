<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
 
/**
 * Create table 'ghrix_copymerge_merge'
 */
$table = $installer->getConnection()
    // The following call to getTable('ghrix_copymerge/merge') will lookup the resource for ghrix_copymerge (ghrix_copymerge_mysql4), and look
    // for a corresponding entity called merge. The table name in the XML is ghrix_copymerge_merge, so ths is what is created.
    ->newTable($installer->getTable('ghrix_copymerge/merge'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'ID')
    ->addColumn('date', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT
		), 'Date')
    ->addColumn('cat1', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
        'nullable'  => false,
      ), 'cat1')
     ->addColumn('cat2', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
        'nullable'  => false,
      ), 'cat2')
     ->addColumn('actionc', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
        'nullable'  => false,
      ), 'Action');
     //~ ->addColumn('recursive', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
        //~ 'nullable'  => false,
      //~ ), 'Recursive');    
$installer->getConnection()->createTable($table);
 
$installer->endSetup();
