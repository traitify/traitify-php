<?php 
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Subscriber\History;
class traitifyMocker{
	public $client;

	public function __construct(){
		$this->client = new Traitify\Client(['host'=>'api.awesome.com', 'privateKey'=>'thisIsPrivateKey', 'version'=>'v1']);
		return $this;
	}
	public function mock($requestName){
		$traitify = $this->client;
		$mock = new Mock(['./tests/mocks/'.$requestName.'.rest']);

    	$traitify->client->getEmitter()->attach($mock);
    	return $traitify;
	}
}
?>