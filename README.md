traitify-php
============

System Setup

Install Composer
[Get Composer](https://getcomposer.org/doc/00-intro.md#globally)

Create composer.json file or add the below json to your composer file:
```
{
  "require": {
      "traitify/client": "dev-master"
  }
}
```

```
$traitify = new \Traitify\Client();
$traitify->set_host("api.traitify.com");
$traitify->set_private_key("your private key");
$traitify->set_version("v1");
```

To create Assessment
```
$deck_id = "your deck id";
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

