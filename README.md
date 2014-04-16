traitify-php
============


To create Assessment
```
require "traitify.php";
$traitify = new Traitify();
$traitify->host = "api.traitify.com";
$traitify->deck_id = "your deck id";
$traitify->public_key = "your public key";
$traitify->private_key = "your private key";
$traitify->version = "v1";
echo($assessment = $traitify->create_assessment()->id);
```


To render Slide Deck
```
require "traitify.php";
$traitify = new Traitify();
$traitify->host = "api.traitify.com";
$traitify->deck_id = "your deck id";
$traitify->public_key = "your public key";
$traitify->private_key = "your private key";
$traitify->version = "v1";
$assessment = $traitify->create_assessment()->id;
$traitify->render_slide_deck($assessment);
```
