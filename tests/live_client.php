<?php
require('tests/support/spec_helper.php');
use GuzzleHttp\Subscriber\History;

class TraitifyClient extends specHelper{ 
  public function testGetDecks(){
    $response = $this->traitify()->getDecks();
  }

  public function testGetSlides(){
    $assessmentId = $this->assessmentId();
    $response = $this->traitify()->getSlides($assessmentId);
  }

  public function testAddSlides(){
    $assessmentId = $this->assessmentId();
    $slideId = $this->slideId();
    $response = $this->traitify()->addSlides($assessmentId, [["id"=>$slideId, "response"=>true, "time_taken"=>1000]]);
  }

  public function testAddSlide(){
    $assessmentId = $this->assessmentId();
    $slideId = $this->slideId();

    $response = $this->traitify()->addSlide($assessmentId, $slideId, true, 1000);
  }

  public function testGetPersonalityTypes(){
    $assessmentId = $this->playedAssessmentId();

    $response = $this->traitify()->getPersonalityTypes($assessmentId);

  }

  public function testGetPersonalityTraits(){
    $assessmentId = $this->playedAssessmentId();

    $response = $this->traitify()->getPersonalityTraits($assessmentId);
  }

  public function testGetCareerMatches(){
    $assessmentId = $this->playedAssessmentId();

    $response = $this->traitify()->getCareerMatches($assessmentId);

    $this->assertNotEquals($response[0]->career->title, "");
  }

  public function testGetOneCareerMatch(){
    $assessmentId = $this->playedAssessmentId();

    $response = $this->traitify()->getCareerMatches($assessmentId, 1);

    $this->assertEquals(count($response), 1);
  }

  public function testGetOneCareerMatchExperienceLevelFive(){
    $assessmentId = $this->playedAssessmentId();

    $response = $this->traitify()->getCareerMatches($assessmentId, 1, [5]);

    $this->assertEquals($response[0]->career->experience_level->id, 5);
  }

  public function slideId(){
    return $this->traitify()->getSlides($this->assessmentId())[0]->id;
  }

  public function playedAssessmentId(){
    $assessmentId = $this->assessmentId();
    $response = [];
    foreach($this->traitify()->getSlides($assessmentId) as $slide){
      array_push($response, ["id"=>$slide->id, "response"=>true, "time_taken"=>1000]);
    }

    $this->traitify()->addSlides($assessmentId, $response);
    return $assessmentId;
  }

  public function traitify(){
    $this->history = new History();
    $this->traitifyClient = new Traitify\Client(['host'=>'api-sandbox.traitify.com', 'secretKey'=>'secret key goes here', 'version'=>'v1']);
    $this->traitifyClient->client->getEmitter()->attach($this->history);
    return $this->traitifyClient;
  }

  public function assessmentId(){
    $this->assessment = $this->traitify()->createAssessment("career-deck");
    return $this->assessment->id;
  }
}
?>