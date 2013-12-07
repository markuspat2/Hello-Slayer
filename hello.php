<?php
/**
 * @package Hello_Slayer
 * @version 1.0
 */
/*
Plugin Name: Hello Slayer
Plugin URI: Nope
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Tom Araya: Rainin Blood. When activated you will randomly see a lyric from <cite>Hello, slayer</cite> in the upper right of your admin screen on every page. 

Ps. I totally stole this from Matt Mullenweg. Thanks Matt!
Author: Mark Patterson 
Version: 1.0
Author URI: Nope again
*/

function hello_slayer_get_lyric() {
	/** These are the lyrics to Hello Slayer */
	$lyrics = "Hello, Slayer
Trapped in purgatory 
A lifeless object, alive 
Awaiting reprisal 
Death will be their acquisition 

The sky is turning red 
Return to power draws near 
Fall into me, the skys crimson tears 
Abolish the rules made of stone 

Pierced from below, souls of my treacherous past 
Betrayed by many, now ornaments dripping above 

Awaiting the hour of reprisal 
Your time slips away 

Raining blood 
From a lacerated sky 
Bleeding it's horror 
Creating my structure 
Now I shall reign in blood!

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_slayer() {
	$chosen = hello_slayer_get_lyric();
	echo "<p id='slayer'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_slayer' );

// We need some CSS to position the paragraph
function slayer_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#slayer {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'slayer_css' );

?>