<?php
require "image.class.php";
$image = new Image("001.jpg");
$content = "hello world !";
$loca= array('x' => 30, 'y'=>100);
$image->angle=30;
// $image->fontMark($content,$loca);
$image->thumb(400,260);
$image->fontMark($content,$loca);
$image->show();
?>