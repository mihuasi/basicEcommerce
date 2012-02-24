<?php
defined('_JEXEC') or die( 'Restricted access' );


jimport('joomla.application.component.model');

class lamptestModelProducts extends JModel
	{
	
	
	function __construct(){
		parent::__construct();
		}  
	
	
	
	
	
			function getProducts()
	{
		$query = 'SELECT * FROM #__lamptest_products ORDER BY id'; 			
		$this->_db->setQuery($query);
		$_products = $this->_db->loadObjectList();
		
			return $_products;
	
	
	}
	
		function getPrePaidVouchers()
	{
		$query = 'SELECT * FROM #__lamptest_vouchers WHERE threshold = 0 ORDER BY id'; 			
		$this->_db->setQuery($query);
		$_prepvouchers = $this->_db->loadObjectList();
		
			return $_prepvouchers;
	
	
	}

		function getThresholdVouchers()
	{
		$query = 'SELECT * FROM #__lamptest_vouchers WHERE threshold > 0 ORDER BY id'; 			
		$this->_db->setQuery($query);
		$_thresholdvouchers = $this->_db->loadObjectList();
		
			return $_thresholdvouchers;
	
	
	}

	function getBasketProducts()
	{
		$query = 'SELECT lp.* FROM #__lamptest_basket lb, #__lamptest_products lp WHERE voucher_id = 0 AND lb.product_id = lp.id ORDER BY id'; 			
		$this->_db->setQuery($query);
		$_products = $this->_db->loadObjectList();
		
			return $_products;
	
	
	}

	function getBasketVouchers()
	{
		$query = 'SELECT lv.* FROM #__lamptest_basket lb, #__lamptest_vouchers lv WHERE product_id = 0 AND lb.voucher_id = lv.id ORDER BY id'; 			
		$this->_db->setQuery($query);
		$_vouchers = $this->_db->loadObjectList();
		
			return $_vouchers;
	
	
	}

		function checkOutTotal()
	{
		$query = 'SELECT SUM(lp.price) as checkouttotal FROM #__lamptest_basket lb, #__lamptest_products lp WHERE voucher_id = 0 AND lb.product_id = lp.id'; 			
		$this->_db->setQuery($query);
		$_checkOutTotal = $this->_db->loadObject();
		
			return $_checkOutTotal;
	
	
	}

		function voucherDiscount()
	{
		$query = 'SELECT SUM(lv.value) as voucherdiscount FROM #__lamptest_basket lb, #__lamptest_vouchers lv WHERE product_id = 0 AND lb.voucher_id = lv.id'; 			
		$this->_db->setQuery($query);
		$_voucherDiscount = $this->_db->loadObject();
		
			return $_voucherDiscount;
	
	
	}
	
	
	} 
	
	
