<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 

$shop_url = "index.php?option=com_lamptest&view=products";
if($_GET['stage'] != "checkout") {
?> <h2 style="text-align:center;">Products</h2> 

<ul>
<?php
foreach($this->products as $p) {
	echo "<li>" . $p->name . " : £" . number_format( $p->price, 2 ) . " - <a href='".$shop_url."&pid=".$p->id."&pname=".$p->name."&task=addproduct'>Add to basket</a></li>";
}

?>

</ul>
<? } ?>
<h2 style="text-align:center;">Vouchers</h2> 

<ul>
<?php
if($_GET['stage'] != "checkout") {
	foreach($this->prepvouchers as $pv) {
		echo "<li>" . $pv->name . " - <a href='".$shop_url."&pvid=".$pv->id."&task=addvoucher'>Apply</a></li>";
	}
} else {
	foreach($this->thresholdvouchers as $tv) {
		echo "<li>" . $tv->name . " - <a href='".$shop_url."&pvid=".$tv->id."&task=addtvoucher&threshold=".$tv->threshold."&total=".$this->total."'>Apply</a></li>";
	}
}

?>



</ul>


<h2 style="text-align:center;"><?php echo ($_GET['stage'] == "checkout") ? "Checkout" : "Your Basket"; ?></h2> 
<div style="text-align:center;">
<?php 
if( $this->basketproducts ) {
$this->basketproducts[] = "ugly kludge :S";
	foreach($this->basketproducts as $bp) {
		$countp ++;
		if($current_pid != $bp->id || $countp == count($this->basketproducts)) {
			$number_of_a_single_product = $num_this_product[(isset($current_pid)) ? $current_pid : $bp->id];
			if ($number_of_a_single_product) $toprint .= $number_of_a_single_product . " x ";
			$toprint .= $out[(isset($current_pid)) ? $current_pid : $bp->id] . "<br />";
			$out[$bp->id]= $bp->name . " @ £" . number_format($bp->price, 2);
			$num_this_product[$bp->id] = 1;
		}
		else $num_this_product[$bp->id] ++;


		$current_pid = $bp->id;
		$current_name = $bp->name;
	}
}

$toprint .= "-------------- <br />";
$toprint .= "Checkout Total: £" . number_format($this->checkouttotal->checkouttotal, 2) . "<br />";
$toprint .= "-------------- <br />";

if( $this->basketvouchers ) {
$this->basketvouchers[] = "ugly kludge :S";
	foreach($this->basketvouchers as $bv) {
		$countv ++;
		if($current_vid != $bv->id || $countv == count($this->basketvouchers)) {
			$number_of_a_single_voucher = $num_this_voucher[(isset($current_vid)) ? $current_vid : $bp->id];
			if ($number_of_a_single_voucher) $toprint .= $number_of_a_single_voucher . " x ";
			$toprint .= $out[(isset($current_vid)) ? $current_vid : $bv->id] . "<br />";
			$out[$bv->id]= $bv->name . " Applied";
			$num_this_voucher[$bv->id] = 1;
		}
		else $num_this_voucher[$bv->id] ++;


		$current_vid = $bv->id;
		$current_name = $bv->name;
	}
}
$toprint .= "-------------- <br />Total: £". number_format($this->total, 2) . "<br /><br />";

echo $toprint;

if($_GET['stage'] != "checkout") {
?>

<a class="button" href="<?php echo $shop_url; ?>&stage=checkout">Checkout </a>

<?php } ?>

<br />
<br />
<a class="button" href="<?php echo $shop_url; ?>&task=delete">Clear Basket </a>
</div>

<?php
