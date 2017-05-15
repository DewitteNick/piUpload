<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 06/05/2017
 * Time: 19:51
 */

$parameter = $_GET['parameter'];

foreach($parameter as $item) {
	echo "<h1>$item</h1>";
}