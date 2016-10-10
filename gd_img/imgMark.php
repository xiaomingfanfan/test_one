<?php
//打开图片
	//1.配置图片路径
	$src = "001.jpg";
	//2.获取图片基本信息
	$info = getimagesize($src);
	//3.通过图像编号来获取图片的类型
	$type = image_type_to_extension($info[2],false);
	//4.在内存中创建一个和图像类型一样的图片
	$fun = "imagecreatefrom{$type}";
	//5.把图片复制到内存中
	$image = $fun($src);
// 操作图片
	//1.设置水印的路径
	$image_Mark = "002.png";
	//2.获取水印图片的基本信息
	$info2 = getimagesize($image_Mark);
	//3.通过水印的图像编号来获取水印图片的类型
	$type2 = image_type_to_extension($info2[2],false);
	//4.在内存中创建一个和水印图像一致的图像类型
	$fun2 = "imagecreatefrom{$type2}";
	//5.把水印图片复制到内存中
	$water = $fun2($image_Mark);
	//6.合并图片
	imagecopymerge($image, $water, 20, 30, 0, 0, $info2[0], $info2[1], 10);
	//7.销毁水印图片
	imagedestroy($water);
//输出图片
	//在浏览器中输出图片
	header("Content-type:".$info['mime']);
	$funs = "image{$type}";
	$funs($image);
//销毁图片
	imagedestroy($image);