<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.view');
class lamptestViewProducts extends JView 
{
	function display($tpl = null)
	{
		global $option;
		$model = &$this->getModel();
		$products = $model->getProducts();
		$prepvouchers = $model->getPrePaidVouchers();
		$thresholdvouchers = $model->getThresholdVouchers();
		$basketproducts = $model->getBasketProducts();
		$basketvouchers = $model->getBasketVouchers();
		$checkouttotal = $model->checkOutTotal();
		$voucherDiscount = $model->voucherDiscount();

		$total = $checkouttotal->checkouttotal - $voucherDiscount->voucherdiscount;
		
		$this->assignRef('params', $params);
		$this->assignRef('products', $products);
		$this->assignRef('prepvouchers', $prepvouchers);
		$this->assignRef('thresholdvouchers', $thresholdvouchers);
		$this->assignRef('basketproducts', $basketproducts);
		$this->assignRef('basketvouchers', $basketvouchers);
		$this->assignRef('checkouttotal', $checkouttotal);
		$this->assignRef('total', $total);
		parent::display($tpl);
	}
}
?>
