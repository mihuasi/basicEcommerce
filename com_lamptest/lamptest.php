<?php
defined('_JEXEC') or die('Restricted access');
require_once( JPATH_COMPONENT.DS.'controller.php' );
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_lamptest'.DS.'tables');
$controller = new lamptestController();
$controller->execute( JRequest::getVar( 'task' ) );
$controller->redirect();
?>
