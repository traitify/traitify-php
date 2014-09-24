<?php
require('tests/support/spec_helper.php');

class TraitifyClient extends specHelper{

  public function testNewClient(){
    $client = new Traitify\Client(['host'=>'api.awesome.com', 'privateKey'=>'thisIsPrivateKey', 'version'=>'v1']);
    $this->assertEquals($client->privateKey, "thisIsPrivateKey");
    $this->assertEquals($client->host, "api.awesome.com");
    $this->assertEquals($client->version, "v1");
  }

  public function testSetClientProperties(){
    $client = new Traitify\Client(['host'=>'api.awesome.com', 'privateKey'=>'thisIsPrivateKey', 'version'=>'v1']);

    $this->assertEquals($client->host, "api.awesome.com");
    $client->setHost("other");
    $this->assertEquals($client->host, "other");

    $this->assertEquals($client->privateKey, "thisIsPrivateKey");
    $client->setPrivateKey("otherPrivateKey");
    $this->assertEquals($client->privateKey, "otherPrivateKey");

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
}
