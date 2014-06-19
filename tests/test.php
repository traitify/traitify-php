<?php

class TraitifyTests extends PHPUnit_Framework_TestCase{
    public $public_key = "A Key";
    public $version = "v1";
    public function testSetHost(){
        $traitify = new Traitify();

        $traitify->set_host("host_name");

        // Assert
        $this->assertEquals("host_name", $traitify->host);
    }

    public function testSetVersion(){
        $traitify = new Traitify();
        
        $traitify->set_version("host_name");

        // Assert
        $this->assertEquals("host_name", $traitify->version);
    }

    public function testSetPublicKey(){
        $traitify = new Traitify();
        
        $traitify->set_private_key("my_key");

        // Assert
        $this->assertEquals("my_key", $traitify->private_key);
    }

    public function testCreateAssessment(){
        $traitify = new Traitify();
        $traitify->set_host("http://api-staging.traitify.com");
        $traitify->set_version($this->version);
        $traitify->set_private_key($this->public_key);

        // Assert
        $this->assertNotEmpty($traitify->create_assessment("f5bc482e-8a2a-45c1-a7d4-8574625396b9")->id);
    }

    public function testGetSlides(){
        $traitify = new Traitify();
        $traitify->set_host("http://api-staging.traitify.com");
        $traitify->set_version($this->version);
        $traitify->set_private_key($this->public_key);
        $id = $traitify->create_assessment("f5bc482e-8a2a-45c1-a7d4-8574625396b9")->id;
        $slides = $traitify->get_slides($id);

        // Assert
        $this->assertNotEmpty($slides);
    }
}
?>