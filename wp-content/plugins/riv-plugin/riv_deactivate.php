<?php

function riv_deactivate(){
	$date = "[".date('d-m-Y H:i:s')."]";
	error_log($date. " Plugin deactivated\r\n", 3, dirname(__FILE__).'/riv_errors.log');
}