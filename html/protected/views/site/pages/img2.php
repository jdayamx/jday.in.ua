<?php
/* Create new object */
$im = new Imagick('http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png');

/* Create new checkerboard pattern */
//$im->newPseudoImage(100, 100, "pattern:checkerboard");

/* Set the image format to png */
$im->setImageFormat('png');

/* Fill new visible areas with transparent */
$im->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);

/* Activate matte */
$im->setImageMatte(true);

/* Control points for the distortion */
$controlPoints = array( 10, 10,
                        10, 5,

                        10, $im->getImageHeight() - 20,
                        10, $im->getImageHeight() - 5,

                        $im->getImageWidth() - 10, 10,
                        $im->getImageWidth() - 10, 20,

                        $im->getImageWidth() - 10, $im->getImageHeight() - 10,
                        $im->getImageWidth() - 10, $im->getImageHeight() - 10);

/* Perform the distortion */
$im->distortImage(Imagick::DISTORTION_PERSPECTIVE, $controlPoints, true);

/* Ouput the image */
echo '<img src="data:image/png;base64,' . base64_encode($im) . '" />';
?>
<?php
$image = new imagick( "http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png" );
$points = array(
                0,0, 25,25,
               100,0, 100,50
               );
$image->setimagebackgroundcolor("#fad888");
$image->setImageVirtualPixelMethod( imagick::VIRTUALPIXELMETHOD_BACKGROUND );
$image->distortImage(  Imagick::DISTORTION_AFFINE, $points, TRUE );
echo '<img src="data:image/png;base64,' . base64_encode($image) . '" />';
?>

Affine Projection

<?php
$image = new imagick( "http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png" );
$points = array( 0.9,0.3,
                -0.2,0.7,
                 20,15 );
$image->setimagebackgroundcolor("#fad888");
$image->setImageVirtualPixelMethod( imagick::VIRTUALPIXELMETHOD_BACKGROUND );
$image->distortImage( Imagick::DISTORTION_AFFINEPROJECTION, $points, TRUE );
echo '<img src="data:image/png;base64,' . base64_encode($image) . '" />';
?>

Arc

<?php
$image = new imagick( "http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png" );
$draw = new imagickdraw();
$degrees = array( 180 );
$image->setimagebackgroundcolor("#fad888");
$image->setImageVirtualPixelMethod( imagick::VIRTUALPIXELMETHOD_BACKGROUND );
$image->distortImage( Imagick::DISTORTION_ARC, $degrees, TRUE );
echo '<img src="data:image/png;base64,' . base64_encode($image) . '" />';
?>

Rotated Arc

<?php
$image = new imagick( "http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png" );
$draw = new imagickdraw();
$degrees = array( 180, 45, 100, 20 );
$image->setimagebackgroundcolor("#fad888");
$image->setImageVirtualPixelMethod( imagick::VIRTUALPIXELMETHOD_BACKGROUND );
$image->distortImage( Imagick::DISTORTION_ARC, $degrees, TRUE );
echo '<img src="data:image/png;base64,' . base64_encode($image) . '" />';
?>

Bilinear

<?php
$image = new imagick( "http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png" );
$points = array(
                0,0, 25,25, # top left
                176,0, 126,0, # top right
                0,135, 0,105, # bottom right
                176,135, 176,135 # bottum left
                );
$image->setimagebackgroundcolor("#fad888");
$image->setImageVirtualPixelMethod( imagick::VIRTUALPIXELMETHOD_BACKGROUND );
$image->distortImage( Imagick::DISTORTION_BILINEAR, $points, TRUE );
echo '<img src="data:image/png;base64,' . base64_encode($image) . '" />';
?>

Perspective

<?php
$image = new imagick( "http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png" );
$points = array(
                0,0, 25,25, # top left
                176,0, 126,0, # top right
                0,135, 0,105, # bottom right
                176,135, 176,135 # bottum left
                );
$image->setimagebackgroundcolor("#fad888");
$image->setImageVirtualPixelMethod( imagick::VIRTUALPIXELMETHOD_BACKGROUND );
$image->distortImage( Imagick::DISTORTION_PERSPECTIVE, $points, TRUE );
echo '<img src="data:image/png;base64,' . base64_encode($image) . '" />';
?>

Scale Rotate Translate

<?php
$image = new imagick( "http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png" );
$points = array(
                 1.5, # scale 150%
                 150 # rotate
               );
$image->setimagebackgroundcolor("#fad888");
$image->setImageVirtualPixelMethod( imagick::VIRTUALPIXELMETHOD_BACKGROUND );
$image->distortImage( imagick::DISTORTION_SCALEROTATETRANSLATE, $points, TRUE );
echo '<img src="data:image/png;base64,' . base64_encode($image) . '" />';
?>

 <?php
$im = new imagick( 'http://jday.in.ua/uploads/Textures/de_detsadik_RF.bsp/de_detsadik_RF.bsp_8b1617f66ee6ee245dc22e63fe63593b.png' );
$distort = array( 0,0, 0,0, 0,100, 20,100, 0,200, 0,200, 133,200, 133,180, 266,200, 266,200, 266,100, 246,100, 266,0, 266,0, 133,0, 133,20  );
$im->setImageVirtualPixelMethod( Imagick::VIRTUALPIXELMETHOD_TRANSPARENT );
$im->setImageMatte( TRUE );
$im->distortImage( Imagick::DISTORTION_SHEPARDS, $distort, FALSE );
echo '<img src="data:image/png;base64,' . base64_encode($im) . '" />';;
 ?>
