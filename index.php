<?php
/* 
	SUberGallery.php
	
	I honestly just copied this from my website
	Abuses UberGallery and turns it into a full fledged gallery script... sorta
	Honestly I just didnt like any other gallery script
	'Cause I couldn't incorperate it into my own layouts
	So here I am, Sam I am!
	
	Requires UberGallery, using the Uber-Naked theme.
	Coded for Bootstrap
	
	Updated Febuary 2022 to become a fork of UberGallery.
	
	THERE ARE HEADER & FOOTER (php) INCLUDES IN THIS CODE!
	If you do not want these, CTRL+F to find them and comment them out.
	
	Eventually I will update this code to make them configurable in the beginning.
*/

////////////////////////////////////////////////////////////////
// CONFIG
///////////////////////////////////////////////////////////////

$galleyPath = "./files/galleries/";

///////////////////////////////////////////////////////////////
// Do NOT go past this unless you know what you're doing!

session_start(); // Do not touch.
$galpal = $_SESSION["current-gal"]; // Do NOT touch.

// Redirection Error Proccessing

$errors = 0;

if(!$_GET["gal"] && $_GET["page"] ) {
	// Not so much an error as it is to enable pagination for all galleries.
	$newpage = "gallery.php?gal=" . $_SESSION["current-gal"] . "&page=" . $_GET["page"] ;
	$errors++;
}

if($_GET["gal"] != "" && !is_dir($galleyPath.$_GET["gal"])) {
	// Makes sure the GET is a real directory, otherwise the script dies.
	unset($_GET["gal"]); unset($_SESSION["current-gal"]);
	// destroys the variables to ensure no bad actors cache.
	$errors++;
	die($galleyPath.$_GET["gal"] . "is not a directory!");
}
	

if($errors > 0) {
	header("Location: $newpage");
	unset($errors);
	die("Redirecting...");
} else { // forces the page to load with no errors.
	
	// be a-Head of the game
	include('header.php');

	// Include the UberGallery class
	include('./resources/UberGallery.php');

	// Initialize the UberGallery object
	$gallery = new UberGallery();
	
	$TheGalleries  = array();
	// makes your gallery array

	$dircount = 0;
	// stops .  and .. from showing up as valid directories
	$scanGal = scandir($galleyPath);
	// scans your galleries path
	foreach($scanGal as $hungryHippo) {
		$dircount++;
		if($dircount >= 3 ) {
			$handSan = preg_replace('/[^\p{L}\p{N}\s]/u', '', $hungryHippo);
			//cleans the directory names.
			// echo "I took " . $hungryHippo . " and see " . $handSan  . "<br />";
			if (is_dir($galleyPath.$handSan."/")) {
				// echo $handSan . " is a valid directory! <br />";
				array_push($TheGalleries, $handSan);
				// pushes each dr into the galleries array/
			} 
		}
	}
	
	unset($hungryHippo);


	if (!$_SERVER['QUERY_STRING'] && !$_GET["gal"]) { 
		unset($_SESSION["gal-check"]);
	?>
	
	<section>
	 	<h1>Image Galleries</h1>
		<p>Gallerys of different series illustrations/screenscaps/artwork, oh my! This is just a small collection.</p>
			<p style="text-align:left">
				<ul style="list-style-image: url(./files/img/folder.gif)">
				<?php foreach($TheGalleries as &$albumBaby) { ?>

					<li>
						<a href="?gal=<?php echo $albumBaby ?>"><?php echo $albumBaby ?></a>
					</li>
				<?php } ?>			
				</ul>
		<p></p>
	</section>

<?php
		} elseif($_GET["gal"] != "") {?>
		<section style="text-align:center;>
			<nav aria-label="breadcrumb">

		<?php

					$_SESSION["current-gal"] = $galpal = $_GET["gal"];
					// Initialize the gallery array
					// prepare your ass
					echo "DEBUG: Hi! I'm looking for images from $galleyPath".$galpal."!<br />";

					?>

				<ol class="breadcrumb arr-right">
					<li class="breadcrumb-item "><a href="gallery.php">Gallery</a></li>
					<?php

					if(strpos($galpal,"/")) {
						#echo "DEBUG: This gallery is a subdirectory!<br />";
						$galleyBabies = explode('/', $galpal);
						$galleyBabiesDeus = sizeof($galleyBabies);
						$i == 0;
						foreach ($galleyBabies as &$memes) { $i++;?>

						<li class="breadcrumb-item<?php
								if($galleyBabiesDeus == $i) {
									echo " active"; }?>" aria-current="page">
								<?php if($galleyBabiesDeus != $i) { ?><?php echo $memes; ?><?php } else { echo $memes; } ?>

						<?php
						}

						unset($memes); // break the reference with the last element

					} else {


						?>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $galpal; ?></li>
					<?php } ?>


					  </ol>
					</nav>

					<p>
					<ul style="list-style-image: url(./files/img/folder.gif);text-align:left">
					<?php /////////////////////////////////////////////


					$testingBabey = array_diff(scandir($galleyPath.$galpal), array('..', '.'));
					foreach($testingBabey as &$forgetMe) {
						if(is_dir($galleyPath.$galpal."/".$forgetMe) == true) {
								echo "<li><a href=\"?gal=$galpal/".$forgetMe."\">$forgetMe</a></li>";
						}
					}
					unset($forgetMe);

					?>
					</ul>
					</p>


					<center>
		<?php


					$galleryArray = $gallery->readImageDirectory($galleyPath.$galpal);

					// Define theme path
					if (!defined('THEMEPATH')) {
							define('THEMEPATH', $gallery->getThemePath());
					}

					// Set path to theme index
					$themeIndex = $gallery->getThemePath(true) . '/index.php';

					// Initialize the theme
					if (file_exists($themeIndex)) {
							include($themeIndex);
					} else {
							die('ERROR: Failed to initialize theme');
					}

					

					?>
					</center>
					</section>
					<?php

			}
	
		// Something is a-Foot
		include("footer.php");

	}
	?>
