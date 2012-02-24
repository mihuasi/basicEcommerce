<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );
class lamptestController extends JController
{
	function display()
	{
		$document =& JFactory::getDocument();
		$viewName = JRequest::getVar('view', 'products');
		$viewType = $document->getType();
		$view = &$this->getView($viewName, $viewType);
		$model =& $this->getModel( $viewName, 'lamptestModel' );
		if (!JError::isError( $model )) {
			$view->setModel( $model, true );
		}
		$view->setLayout('default');
		$view->display();
	}

	function addproduct() {
	  	   $product_to_basket =new stdClass();
		   $product_to_basket->product_id = $_GET['pid'];;
		   $db = JFactory::getDBO();
		   $db->insertObject('#__lamptest_basket', $product_to_basket, id);

		$message = "Product (" . $_GET['pname'] . ") has been added to your basket";
		$this->setRedirect( 'index.php?option=com_lamptest&view=products', $message );
	}

	function addvoucher() {
	  	   $voucher_to_basket =new stdClass();
		   $voucher_to_basket->voucher_id = $_GET['pvid'];;
		   $db = JFactory::getDBO();
		   $db->insertObject('#__lamptest_basket', $voucher_to_basket, id);

		$message = "Voucher has been applied to your basket";
		$this->setRedirect( 'index.php?option=com_lamptest&view=products', $message );
	}

	function addtvoucher() {
		if($_GET['total'] > $_GET['threshold'] ) {
	  	   $voucher_to_basket =new stdClass();
		   $voucher_to_basket->voucher_id = $_GET['pvid'];;
		   $db = JFactory::getDBO();
		   $db->insertObject('#__lamptest_basket', $voucher_to_basket, id);

		$message = "Voucher has been applied to your basket";
		} else {
		$message = "You must spend £". number_format ($_GET['threshold'] - $_GET['total'] , 2) . " more to use this voucher";
		}
		$this->setRedirect( 'index.php?option=com_lamptest&view=products&stage=checkout', $message );
	}


	function delete() {
		$db = & JFactory::getDBO();   
		 $query = $db->getQuery(true);
		 $query->delete('#__lamptest_basket');             
		 $db->setQuery($query);
		 $db->query(); 
		$message = "Your basket has been cleared";
		$this->setRedirect( 'index.php?option=com_lamptest&view=products', $message );
	}

} 






?>
