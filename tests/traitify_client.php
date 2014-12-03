<?php
require('tests/support/spec_helper.php');

class TraitifyClient extends specHelper{

  public function testNewClient(){
    $client = new Traitify\Client(['host'=>'api.awesome.com', 'secretKey'=>'thisIsSecretKey', 'version'=>'v1']);
    $this->assertEquals($client->secretKey, "thisIsSecretKey");
    $this->assertEquals($client->host, "api.awesome.com");
    $this->assertEquals($client->version, "v1");
  }

  public function testSetClientProperties(){
    $client = new Traitify\Client(['host'=>'api.awesome.com', 'secretKey'=>'thisIsSecretKey', 'privateKey'=>'thisIsPrivateKey', 'version'=>'v1']);

    $this->assertEquals($client->host, "api.awesome.com");
    $client->setHost("other");
    $this->assertEquals($client->host, "other");

    $this->assertEquals($client->privateKey, "thisIsPrivateKey");
    $client->setPrivateKey("thisIsPrivateKeyNow");
    $this->assertEquals($client->privateKey, "thisIsPrivateKeyNow");

    $this->assertEquals($client->secretKey, "thisIsSecretKey");
    $client->setSecretKey("thisIsSecretKeyNow");
    $this->assertEquals($client->secretKey, "thisIsSecretKeyNow");

    $this->assertEquals($client->version, "v1");
    $client->setVersion("otherV1");
    $this->assertEquals($client->version, "otherV1");
  }

  public function testRequest(){
    $traitify = $this->mockedClient();

    $traitify->mock("assessmentCreate");

    $response = $traitify->client->request("POST", "/assessments", ["deck_id"=>"career-deck"]);

    $this->assertEquals($response->id, "assessmentId");
  }

  public function testPost(){
    $traitify = $this->mockedClient();

    $traitify->mock("assessmentCreate");

    $response = $traitify->client->post("/assessments", ["deck_id"=>"career-deck"]);

    $this->assertEquals($response->id, "assessmentId");
  }

  public function testGet(){
    $traitify = $this->mockedClient();

    $traitify->mock("assessmentCreate");

    $response = $traitify->client->post("/assessments", ["deck_id"=>"career-deck"]);

    $this->assertEquals($response->id, "assessmentId");
  }

  public function testCreateAssessment(){
    $traitify = $this->mockedClient();

    $traitify->mock("assessmentCreate");

    $assessment = $traitify->client->createAssessment("career-deck");

    $this->assertEquals($assessment->id, "assessmentId");
  }

  public function testGetDecks(){
    $traitify = $this->mockedClient();

    $traitify->mock("getDecks");

    $decks = $traitify->client->getDecks();

    $this->assertEquals($decks[0]->id, "career-deck");
  }

  public function testGetSlides(){
    $traitify = $this->mockedClient();

    $traitify->mock("getSlides");

    $slides = $traitify->client->getSlides("assessmentId");

    $this->assertEquals($slides[0]->id, "da9195e8-94b2-4e5f-b8df-f1dc80d3226d");
  }

  public function testAddSlides(){
    $traitify = $this->mockedClient();

    $traitify->mock("addSlides");

    $slides = $traitify->client->addSlides("assessmentId", [["id"=>"assessmentId", "response"=>true, "response_time"=>0]]);

    $this->assertEquals($slides[0]->id, "3d5a4f6a-86ae-46d8-9434-d5e8dd625eff");
  }

  public function testAddSlide(){
    $traitify = $this->mockedClient();

    $traitify->mock("addSlide");

    $slide = $traitify->client->addSlide("assessmentId", "slideId", "value", "0");

    $this->assertEquals($slide->id, "8abe88d4-f835-4cdf-8418-a5c47198916b");
  }

  public function testGetPersonalityTypes(){
    $traitify = $this->mockedClient();

    $traitify->mock("getPersonalityTypes");

    $personalityTypes = $traitify->client->getPersonalityTypes("assessmentId");

    $this->assertEquals($personalityTypes->personality_blend->personality_type_1->id, "55071620-bca6-4f15-b466-de8733a834a8");
  }

  public function testGetPersonalityTraits(){
    $traitify = $this->mockedClient();

    $traitify->mock("getPersonalityTraits");

    $personalityTraits = $traitify->client->getPersonalityTraits("assessmentId");

    $this->assertEquals($personalityTraits[0]->personality_trait->name, "Aggressive");
  }
}
