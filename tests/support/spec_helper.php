<?php
require('./src/traitify/client.php');
require('./tests/support/mocks.php');

class specHelper extends PHPUnit_Framework_TestCase{
	public function mockedClient(){
		return new traitifyMocker();
	}
}
function puts($variable){
	echo(var_dump($variable));
}
?>