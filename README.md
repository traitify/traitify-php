traitify-php
============

System Setup
```
require "traitify.php";
$traitify = new Traitify();
$traitify->setHost("api.traitify.com");
$deck_id = "your deck id";
$traitify->private_key("your private key");
$traitify->set_version("v1");
```

To create Assessment
```
echo($assessment_id = $traitify->create_assessment()->id);
```

Get Slides
```
$slides = $traitify->get_slides($assessment_id);
```

Get Personality Types
```
$personality_types = $traitify->get_personality_types($assessment_id);
```

Get Personality Traits
```
$personality_traits = $traitify->get_personality_traits($assessment_id);
```