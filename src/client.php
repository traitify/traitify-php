<?php
/**
 * Traitify Client.
 * @author Carson Wright
 * @author Carson Wright carsonnwright@gmail.com
 */
namespace Traitify;

require('vendor/autoload.php');

use GuzzleHttp\Client as GuzzleClient;

/**
 * Traitify Api client
 */
class Client {
	/**
		* Holds the Traitify publicKey
	*/
	public $publicKey;

	/**
  * Holds the Traitify host
  */
	public $host;

	/**
  * Holds the Traitify version
  */
	public $version;


	/**
     * Clients accept an array of constructor parameters.
     *
     * Here's an example of creating a client:
     *
     *     $client = new Client([
     *         'host' => 'api.traitify.com',
     *         'version' => 'v1',
     *         'secretKey' => 'as8sdf8sd-sdf8asf8sdf-asdf8sdffsdfd'
     *     ]);
     *
     * @param array $config Client configuration settings
     *     - host: The host that you wish to query for example api.traitify.com, or api-sandbox.traitify.com
     *     - version: The version of the api you wish to query v1 for example
     *     - secretKey: The secret key you wish to send to the traitify's api
     */
	public function __construct(array $config = []){
		$this->host = $config["host"];
		$this->version = $config["version"];
		if(isset($config["secretKey"])){
			$this->secretKey = $config["secretKey"];
		}elseif (isset($config["privateKey"])){
			// depracted, but keeping this here for backwards compatability
			$this->secretKey = $config["privateKey"];
		}
		$this->client = new GuzzleClient();

		return $this;
	}
	/**
  * Set's the host for the Client instance.
  *
  * Set's the Client instance $host variable
  *
  * @param string $host sets the $this['host'] variable
  *
  * @return void
  */
	public function setHost($host){
		$this->host = $host;
	}
	/**
  * Set's the secret key for the Client instance.
  *
  * Set's the Client instance $version variable
  *
  * @param string $version sets the $this['version'] variable
  *
  * @return void
  */
	public function setVersion($version){
		$this->version = $version;
	}

	/**
  * DEPRECATED: Set's the secret key for the Client instance.
  *
  * Set's the Client instance $config variable
  *
  * @param string $key sets the $config['secretKey'] config variable
  *
  * @return void
  */

	public function setPrivateKey($key){
		$this->secretKey = $key;
	}
	/**
  * Set's the secret key for the Client instance.
  *
  * Set's the Client instance $config variable
  *
  * @param string $key sets the $config['secretKey'] config variable
  *
  * @return void
  */
	public function setSecretKey($key){
		$this->secretKey = $key;
	}

	/**
  * Makes a request to traitify api
  *
  * Uses Guzzle to make any request to the Traitify Api
  *
  * @param string $verb defines what type of http verb you want to request
  *
  * @param string $path defines what endpoint you want to request
  *
  * @param string $params defines what endpoints you want to send with the request
  *
  * @return Array
  */
	public function request($verb, $path, array $params = []){
		if($this->secretKey){
			$key = $this->secretKey;
		}else{
			$key = $this->pricateKey;
		}
		$options['body'] = json_encode($params);
		$options['auth'] = [$key, "x"];
		$options['headers'] = [
			'Accept' => 'application/json',
			'Content-Type'  => 'application/json'
		];

		$request = $this->client->createRequest($verb, 'https://'.$this->host."/v1".$path, $options);
		$response = $this->client->send($request);
		return json_decode($response->getBody());
	}

	/**
  * Makes a Get request to traitify api
  *
  * Uses Guzzle to make any get request to the Traitify Api
  *
  * @param string $path defines what endpoint you want to request
  *
  * @param string $params defines what endpoints you want to send with the request
  *
  * @return Array
  */
	public function get($path, array $params = []){
		return $this->request("GET", $path, $params);
	}

	/**
  * Makes a Put request to traitify api
  *
  * Uses Guzzle to make any put request to the Traitify Api
  *
  * @param string $path defines what endpoint you want to request
  *
  * @param string $params defines what endpoints you want to send with the request
  *
  * @return Array
  */
	public function put($path, array $params = []){
		return $this->request("PUT", $path, $params);
	}


	/**
  * Makes a Post request to traitify api
  *
  * Uses Guzzle to make any post request to the Traitify Api
  *
  * @param string $path defines what endpoint you want to request
  *
  * @param string $params defines what endpoints you want to send with the request
  *
  * @return Array
  */
	public function post($path, array $params = []){
		return $this->request("POST", $path, $params);
	}


	/**
  * Makes a Delete request to traitify api
  *
  * Uses Guzzle to make any delete request to the Traitify Api
  *
  * @param string $path defines what endpoint you want to request
  *
  * @param string $params defines what endpoints you want to send with the request
  *
  * @return Array
  */
	public function delete($path, array $params = []){
		return $this->request("DELETE", $path, $params);
	}


	/**
  * Create Assessment
  *
  * Uses post to make a create assessment request to the Traitify Api
  *
  * @param string $deckId defines what deck you want to send with the request
  *
  * @return Array
  */
	public function createAssessment($deckId){
		return $this->post('/assessments/', ["deck_id"=>$deckId]);
	}

	/**
  * Get Decks
  *
  * Uses get to make a request to the Traitify Api
  *
  * @return Array
  */
	public function getDecks(){
		return $this->get('/decks');
	}

	/**
  * Get Slides
  *
  * Uses get to make a request to the Traitify Api
  *
  * @param string $assessmentId defines what assessment id you want to get slides for
  *
  * @return Array
  */
	public function getSlides($assessmentId){
		return $this->get('/assessments/'.$assessmentId.'/slides');
	}

	/**
  * Add Slide
  *
  * Uses get to make a request to the Traitify Api
  *
  * @param string $assessmentId defines what assessment id you want to set a slide
  *
  * @param string $slideId defines what slide id you want to set on the assessment
  *
  * @param string $value defines what response value
  *
  * @param string $timeTaken defines how long the user took to choose
  *
  * @return Array
  */
	public function addSlide($assessmentId, $slideId, $value, $timeTaken){
		return $this->put('/assessments/'.$assessmentId.'/slides/'.$slideId, ["response"=>$value, "time_taken"=>$timeTaken]);
	}

	/**
  * Add Slides
  *
  * Uses get to make a request to the Traitify Api
  *
  * @param string $assessmentId defines what assessment id you want to get slides for
  *
  * @param string $slideValues defines what values should be sent for slides
  *
  * @return Array
  */
	public function addSlides($assessmentId, array $slideValues){
		return $this->put('/assessments/'.$assessmentId.'/slides', $slideValues);
	}

	/**
  * Get Personality Types
  *
  * Uses get to make a request to the Traitify Api
  *
  * @param string $assessmentId defines what assessment id you want to get personality types for
  *
  * @param string $options is optional and can be used to define which image pack you get back
  *
  * @return Array
  */
	public function getPersonalityTypes($assessmentId, $options = []){
		if(!isset($options["image_pack"])){
			$options["image_pack"] = "linear";
		}
		return $this->get('/assessments/'.$assessmentId.'/personality_types', $options);
	}

	/**
  * Get Personality Traits
  *
  * Uses get to make a request to the Traitify Api
  *
  * @param string $assessmentId defines what assessment id you want to get personality traits for
  *
  * @return Array
  */
	public function getPersonalityTraits($assessmentId){
		return $this->get('/assessments/'.$assessmentId.'/personality_traits/raw');
	}

	/**
  * Get Career Matches
  *
  * Uses get to make a request to the Traitify Api
  *
  * @param string $assessmentId defines what assessment id you want to get personality traits for
  * @param integer $numberOfMatches defines the number of career matches you want returned
  * @param array $experienceLevels defines the experience levels of the careers you want returned, can be 1, 2, 3, 4, or 5
  *
  * @return Array
  */
	public function getCareerMatches($assessmentId, $numberOfMatches = NULL, $experienceLevels = []){
		$url = '/assessments/'.$assessmentId.'/matches/careers?x=1';
		if(!is_null($numberOfMatches)){
			$url = $url.'&number_of_matches='.$numberOfMatches;
		}
		if(count($experienceLevels) > 0){
			$url = $url.'&experience_levels='.implode(",", $experienceLevels);
		}
		return $this->get($url);
	}
}
