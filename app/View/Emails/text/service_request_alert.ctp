<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php
	$mainService = $this->Session->read('mainService');
	$subService = $this->Session->read('subService');

	if (AuthComponent::user('customer_id')) {
		echo "Customer ID : ".AuthComponent::user('customer_id')."\n";
	}
	if (AuthComponent::user('name')) {
		echo "Customer Name : ".AuthComponent::user('name')."\n";
	}
	if (AuthComponent::user('email')) {
		echo "Customer Email : ".AuthComponent::user('email')."\n";
	}
	if (AuthComponent::user('phone_number')) {
		echo "Customer Contact Number : ".AuthComponent::user('phone_number')."\n";
	}
	if (AuthComponent::user('address')) {
		echo "Customer Address : ".AuthComponent::user('address')."\n\n";
	}
	echo "*".$mainService. " > " .$subService."*"."\n\n";
	$content = $this->Session->read('emailContent');
	$tmp = '' ;
	$contentStr = explode('###', $content);
	foreach ($contentStr as $contentStrkey => $contentStrvalue) {
		$contentStr = explode('<br/>', $contentStrvalue);
		foreach ($contentStr as $key => $value) {
			$tmp .= $value."\n";
		}
		$tmp = $tmp."\n";
	}
	echo $tmp;
?>