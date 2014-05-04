<?php
class Traitify{
	public function create_assessment($deck_id = ""){
		$curl = curl_init();

		$url = $this->host . "/" . $this->version . "/assessments";

		curl_setopt($curl, CURLOPT_POST, 1);

		if($deck_id){
			$data = json_encode(Array("deck_id"=>$deck_id));	
		}else{
			$data = json_encode(Array("deck_id"=>$this->deck_id));
		}
		

		if($data){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
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

	public function render_slide_deck($assessment_id = ""){
		if(!$assessment_id){
			$assessment_id = $this->create_assessment()->id;
		}
		$script = Array();

		array_push($script, '<script src="https://s3.amazonaws.com/traitify-cdn/js/api/1.0.0.js"></script>');
		array_push($script, '<script src="https://s3.amazonaws.com/traitify-cdn/js/slide_deck/1.0.0.js"></script>');
		/**************************************
		 * Currently on rolling release
		 * Totem Style:
		 **************************************/
		array_push($script, '<script src="https://s3.amazonaws.com/traitify-cdn/js/results/prop/1.0.0.js"></script>');
		array_push($script, "<div class='traitify'><br/></div>");
		array_push($script, "<script>");
		array_push($script, "Traitify.setHost('".$this->host."');");
		array_push($script, "Traitify.setVersion('".$this->version."');");
		array_push($script, "Traitify.setPublicKey('".$this->public_key."');");
		array_push($script, "Traitify.ui.slideDeck('".$assessment_id."','.traitify', function(){ Traitify.ui.resultsProp('".$assessment_id."', '.traitify')});");
		array_push($script, "</script>");
		echo "" . join("", $script) . "";
		return join("", $script);
	}

	public function render_results($assessment_id = ""){
		if(!$assessment_id){
			$assessment_id = $this->create_assessment()->id;
		}
		$script = Array();

		/**************************************
		 * Currently on rolling release
		 * Totem Style:
		 **************************************/
		array_push($script, '<script src="https://s3.amazonaws.com/traitify-cdn/js/api/1.0.0.js"></script>');
		array_push($script, '<script src="https://s3.amazonaws.com/traitify-cdn/js/results/prop/1.0.0.js"></script>');

		array_push($script, "<div class='traitify'><br/></div>");

		array_push($script, "<script>");
		array_push($script, "Traitify.setHost('".$this->host."');");
		array_push($script, "Traitify.setVersion('".$this->version."');");
		array_push($script, "Traitify.setPublicKey('".$this->public_key."');");
		array_push($script, "Traitify.ui.resultsProp('".$assessment_id."', '.traitify');");
		array_push($script, "</script>");
		echo "" . join("", $script) . "";
		return join("", $script);
	}
}
?>