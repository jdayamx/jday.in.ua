<?php




                 //dechex(ord($string[$i]));    }
	$plaintext = "this is a test";
	$encode = User::Password_encode($plaintext);
	$decode = User::Password_decode($encode);

	echo '<b>plaintext: </b>'.$plaintext . "<br>";
	echo '<b>encode: </b>'.$encode . "<br>";
	echo '<b>decode: </b>'.$decode . "<br>";



?>