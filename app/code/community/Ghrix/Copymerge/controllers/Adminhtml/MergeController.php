<?php
class Ghrix_Copymerge_Adminhtml_MergeController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction() 
    {  
        // Let's call our initAction method which will set some basic params for each action
        $this->_initAction()
            ->renderLayout();
    }  
     
    public function newAction()
    {  
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }  
     
    public function editAction()
    {  
        $this->_initAction();
     
        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('ghrix_copymerge/merge');
     
        if ($id) {
            // Load record
            $model->load($id);
     
            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This action no longer exists.'));
                $this->_redirect('*/*/');
     
                return;
            }  
        }  
     
        $this->_title($model->getId() ? $model->getName() : $this->__('New Action'));
     
        $data = Mage::getSingleton('adminhtml/session')->getMergeData(true);
        if (!empty($data)) {
            $model->setData($data);
        }  
     
        Mage::register('ghrix_copymerge', $model);
     
            $this->_addBreadcrumb($id ? $this->__('Edit Action') : $this->__('New Action'), $id ? $this->__('Edit Action') : $this->__('New Action'))
            ->_addContent($this->getLayout()->createBlock('ghrix_copymerge/adminhtml_merge_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }
     
    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
			
			$categoryId1c = $postData['cat1'];
			$categoryId2c = $postData['cat2'];
			
			
           //~ get parent categories of destination category
			$categoryp = Mage::getModel('catalog/category')->load($categoryId2c);

			$catnames = array();
			foreach ($categoryp->getParentCategories() as $parent) {
				$catnames[] = $parent->getID();
			}
			
			//~ get child categories of destination category
			$children = Mage::getModel('catalog/category')->getCategories($categoryId2c);
					
					foreach ($children as $category) {
						$cname[]=$category->getName();
						
				}
				$Category=Mage::getModel('catalog/category')->load($categoryId1c);
                $name=$Category->getName();
                
						
			if($postData['actionc']=='Copy')
			{
				       $categoryId1 = $postData['cat1'];
						$categoryId2 = $postData['cat2'];
						
						
					/********************Custom  code for copy category*******************/

						
					$allStores = Mage::app()->getStores();
					$parentCategory = Mage::getModel('catalog/category')->load($categoryId2);
					$parentCategoryId = $parentCategory->getId();
					$category = Mage::getModel('catalog/category')->load($categoryId1); // The ID of the category you want to copy.
					$copy = clone $category;
					$copy->setId(null);
					
					//~ ++++++++++++check if category already exist++++++++++++++++++//
					$children = Mage::getModel('catalog/category')->getCategories($parentCategoryId);
					
					foreach ($children as $category) {
						$cname[]=$category->getName();
						
				   }
			
				
				$Category=Mage::getModel('catalog/category')->load($categoryId1);
                $name=$Category->getName();
               //~ +++++++++++++++++check if category already exist+++++++++++++++++++++++++++//

				if( in_array( $name ,$cname ) ){
				//~ This category already exist under requested parent category.
				}else{
					
					    //~ Copy and create new category
						foreach ($allStores as $_eachStoreId => $val) 
						{
								$storecategory = Mage::getModel('catalog/category')->setStoreId($_eachStoreId)->load($categoryId1);// The ID of the category you want to copy.
								$copy->setStoreId($_eachStoreId);
								$copy->setName($storecategory->getName());
								$copy->save();
								
						}
						$customcopy=$copy->move($parentCategoryId); 
						$newcat= $customcopy['entity_id'];
				
		
					/********************!Custom  code for copy category*******************/
					
				//***************merge two category products into one*************************//

					//~ $category2Id = $postData['cat2'];
					$categorymId = $postData['cat2'];
					
					$category = new Mage_Catalog_Model_Category();
					$category->load($categoryId1); //My cat id is 
					$prodCollection = $category->getProductCollection();
					foreach ($prodCollection as $product) {
					$prdIds[] = $product->getId(); ///Store all th eproduct id in $prdIds array
					}

					 
					$category2 = new Mage_Catalog_Model_Category();
					$category2->load($categorymId); //My cat id is 
					$prodCollection2 = $category2->getProductCollection();
					foreach ($prodCollection2 as $product2) {
					$prdIds2[] = $product2->getId(); ///Store all th eproduct id in $prdIds array
					}

					 
					 //merge the products into one big array
					 if($prdIds!='' && $prdIds2!='')
					 {
						 $merged = array_merge($prdIds, $prdIds2);
					}
					 if($prdIds=='')
					 {
						$merged = $prdIds2; 
					 }
					if($prdIds2=='')
					 {
						$merged = $prdIds; 
					}
				
					//Open Database Conenction
						  $resource = Mage::getSingleton('core/resource');
						  $writeConnection = $resource->getConnection('core_write');
						  $readConnection = $resource->getConnection('core_read');
						  
							  for($i=1;$i<=count($merged);$i++)
								{
									
									$pid=$merged[$i-1];

					$select= "SELECT `category_id`, `product_id`, `position` FROM catalog_category_product  WHERE (category_id=$categorymId AND product_id=$pid) OR(category_id=$newcat AND product_id=$pid)";
					
									
									 $result1 = $readConnection->fetchAll($select);
									$datacount=count($result1);
									if($datacount == '0')
									{
										//echo 'yes';

									$query1 = "insert into catalog_category_product (`category_id`,`product_id`,`position`) values($categorymId,$pid,1)";
									$query2 = "insert into catalog_category_product (`category_id`,`product_id`,`position`) values($newcat,$pid,1)";
									
									 $result=$writeConnection->query($query1);
									 $result=$writeConnection->query($query2);
											 if($result)
											{
											//echo 'sucess';
											
											}
									}
									else{
										
										//echo 'no';
										
										}
									
									
								  
								}
			  
		//***************merge two category products into one*************************//
				
				
					
					
              }    
		   }
			if($postData['actionc']=='Move')
			{
				
						/********************Custom  Move category*******************/
						$categoryId = $postData['cat1'];
						$parentId = $postData['cat2'];
						
						$categoryp = Mage::getModel('catalog/category')->load($parentId);

						$catnames = array();
						foreach ($categoryp->getParentCategories() as $parent) {
							$catnames[] = $parent->getID();
						}
						
						if(($categoryId == $parentId) || in_array( $categoryId ,$catnames ))
						{
							
							if(in_array( $categoryId ,$catnames ))
							{
							 if($categoryId == $parentId)
								{
									echo 'here';
									$emessage='Name of Source category and destination category should not be same.';
								}else{
									echo 'there';
									$emessage='You cannot move parent category into its child category.';
								}
						   }
							
							$this->_getSession()->addError($this->__($emessage));
							$id  = $this->getRequest()->getParam('id');
							if($id){
								$this->_redirect('*/*/edit',array('id'=>$id));
							}else{
								$this->_redirect('*/*/new');
							}
							return;
							
							}else{
                        $category = Mage::getModel('catalog/category')->load($categoryId);
						$category->move($parentId, null);
					    $newcat= $parentId;
					    //~ exit;
						
					/********************Custom  Move category*******************/
					//***************merge two category products into one*************************//

					//~ $category2Id = $postData['cat2'];
					$categorymId = $postData['cat2'];
					
					$category = new Mage_Catalog_Model_Category();
					$category->load($categoryId); //My cat id is 
					$prodCollection = $category->getProductCollection();
					foreach ($prodCollection as $product) {
					$prdIds[] = $product->getId(); ///Store all th eproduct id in $prdIds array
					}

					 
					$category2 = new Mage_Catalog_Model_Category();
					$category2->load($newcat); //My cat id is 
					$prodCollection2 = $category2->getProductCollection();
					foreach ($prodCollection2 as $product2) {
					$prdIds2[] = $product2->getId(); ///Store all th eproduct id in $prdIds array
					}

					 
					 //merge the products into one big array
					 if($prdIds!='' && $prdIds2!='')
					 {
						 $merged = array_merge($prdIds, $prdIds2);
					}
					 if($prdIds=='')
					 {
						$merged = $prdIds2; 
					 }
					if($prdIds2=='')
					 {
						$merged = $prdIds; 
					}
					
					//Open Database Conenction
						  $resource = Mage::getSingleton('core/resource');
						  $writeConnection = $resource->getConnection('core_write');
						  $readConnection = $resource->getConnection('core_read');
						  
							  for($i=1;$i<=count($merged);$i++)
								{
									
									$pid=$merged[$i-1];

					$select= "SELECT `category_id`, `product_id`, `position` FROM catalog_category_product  WHERE category_id=$newcat AND product_id=$pid";
					
									
									 $result1 = $readConnection->fetchAll($select);
									$datacount=count($result1);
									if($datacount == '0')
									{
										//echo 'yes';

									$query1 = "insert into catalog_category_product (`category_id`,`product_id`,`position`) values($newcat,$pid,1)";
									
									 $result=$writeConnection->query($query1);
								
											 if($result)
											{
											//echo 'sucess';
											
											}
									}
									else{
										
										//echo 'no';
										
										}
									
									
								  
								}
			  
		//***************merge two category products into one*************************//
					
					
					
					
			}
		}
            $model = Mage::getSingleton('ghrix_copymerge/merge');
            $model->setData($postData);
 
              try {
		          if( in_array( $name ,$cname )){
			        //~ This category already exist under requested parent category.
				
						Mage::getSingleton('adminhtml/session')->addError($this->__('Requested category already exist please try with another one'));
						$id  = $this->getRequest()->getParam('id');
									if($id){
										$this->_redirect('*/*/edit',array('id'=>$id));
									}else{
										$this->_redirect('*/*/new');
									}
						
						return;
				}else{
				
                $model->save();
 
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The action has been saved.'));
                $this->_redirect('*/*/');
 
                return;
			}
            } 
            catch (Mage_Core_Exception $e) {
                //Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                 
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this action.'));
            }
 
            Mage::getSingleton('adminhtml/session')->setMergeData($postData);
            $this->_redirectReferer();
        }
    }
     
    public function messageAction()
    {
        $data = Mage::getModel('ghrix_copymerge/merge')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }
     
    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('merge/ghrix_copymerge_merge')
            ->_title($this->__('Category Handler'))->_title($this->__('Category Handler'))
            ->_addBreadcrumb($this->__('Category Handler'), $this->__('Category Handler'))
            ->_addBreadcrumb($this->__('Category Handler'), $this->__('Category Handler'));
         
        return $this;
    }
     
    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('merge/ghrix_copymerge_merge');
    }
     
    
    public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0) {
			try {
				$deleteact = Mage::getModel('ghrix_copymerge/merge');
				$deleteact->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess('Deleted');
				$this->_redirect('*/*/');
				return; 
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError('There was an error deleteing.');
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				Mage::logException($e);
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError('Could not find record to delete.');
		$this->_redirect('*/*/');
	}
	
	
}
