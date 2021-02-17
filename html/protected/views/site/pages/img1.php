<?php
//Creating two Imagick object
$first = new Imagick('http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png');
//$first = new Imagick('http://jday.in.ua/uploads/Textures/de_arrival_nf.bsp/de_arrival_nf.bsp_1a96324d4950ca9d22d4ec66d8a31a34.png');
$mask = new Imagick('http://jday.in.ua/img/mask/m7.png');
$mask->adaptiveResizeImage($first->getImageWidth(), $first->getImageHeight(), true);

$i1 = new Imagick();
$i1->newImage(256, 256, new ImagickPixel('white'));
$i1->setImageFormat('png');

$i2 = new Imagick();
$i2->newImage(256, 256, new ImagickPixel('white'));
$i2->setImageFormat('png');


//$second = new Imagick('http://jday.in.ua/uploads/Textures/de_arrival_nf.bsp/de_arrival_nf.bsp_1a96324d4950ca9d22d4ec66d8a31a34.png');
//$second = new Imagick('http://jday.in.ua/uploads/Textures/cs_coldfortress.bsp/cs_coldfortress.bsp_80037e599be1c850619b53c4aae5bdee.png');
$second = new Imagick('http://jday.in.ua/uploads/Textures/the_lost_map3.bsp/the_lost_map3.bsp_b809dd2dc0a3e7e7f6be7b79453d33e0.png');


// Set the colorspace to the same value
//$first->setImageColorspace($second->getImageColorspace() );

//Second image is put on top of the first
//$first->compositeImage($second, $second->getImageCompose(), 128, 0);

//$second->adaptiveResizeImage($first->getImageWidth(), $first->getImageHeight(), true);


//$first->compositeImage($mask, imagick::COMPOSITE_COPYOPACITY, 0, 0);
//$second->compositeImage($first, Imagick::COMPOSITE_DEFAULT, 0, 0);

$i1->compositeImage($second, Imagick::COMPOSITE_DEFAULT, 0, 0);
$i2->compositeImage($first, Imagick::COMPOSITE_DEFAULT, 0, 0);
$i2->compositeImage($mask, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
$i1->compositeImage($i2, imagick::COMPOSITE_DEFAULT, 0, 0);



//new image is saved as final.jpg
//$first->writeImage('output.png');
//header("Content-Type: image/png");
echo '<img src="data:image/png;base64,' . base64_encode($first) . '" />';
echo '<img src="data:image/png;base64,' . base64_encode($second) . '" />';
echo '<img src="data:image/png;base64,' . base64_encode($i1) . '" />';
//echo $second;
?>