PHP Example of Traitify
```
<?php
	require "traitify.php";

	$traitify = new Traitify();

	// Config Options
	$traitify->url = "https://api.traitify.com/";
	$traitify->public_key = "your public key";
	$traitify->private_key = "your private key";
	$traitify->version = "v1";
	$traitify->deck_id = "your deck id";

	// Store Assessment
 	$assessment = $traitify->create_assessment()->id;

 	// Render Slide
	$traitify->render_slide_deck($assessment);
?>
```