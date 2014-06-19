<?php class Traitify{
	public function set_host($host){
		$this->host = $host;
	}
	public function set_private_key($private_key){
		$this->private_key = $private_key;
	}
	public function set_version($version){
		$this->version = $version;
	}
	public function request($method, $path, $params){
		$curl = curl_init();

		$url = $this->host . "/" . $this->version . $path;

		if($method == "post"){
			curl_setopt($curl, CURLOPT_POST, 1);
			$params = json_encode($params);
			if($params){
	            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
			}
		}
		

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Accept: application/json',
		    'Content-Type: application/json'
	    ));

    	// Optional Authentication:
    	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    	curl_setopt($curl, CURLOPT_USERPWD, $this->private_key.":x");
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    	return json_decode(curl_exec($curl));
	}
	public function post($path, $params){
		return $this->request("post", $path, $data);
	}
	public function get($path, $params){
		return $this->request("get", $path, $data);
	}
	public function create_assessment($deck_id){
		if($deck_id){
			$data = Array("deck_id"=>$deck_id);	
		}else{
			$data = Array("deck_id"=>$this->deck_id);
		}

		return $this->request("post", "/assessments", $data);
	}
	public function get_slides($assessmentId){
		return $this->get("/assessments/".$assessmentId."/slides", $data);
	}
	public function get_personality_types($assessmentId){
		return $this->get("/assessments/".$assessmentId."/personality_types", $data);
	}
	public function get_personality_traits($assessmentId){
		return $this->get("/assessments/".$assessmentId."/personality_traits", $data);
	}
}

?>