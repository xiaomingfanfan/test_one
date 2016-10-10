<?php
//打开图片
	//1.配置图片路径（就是你想要操作的图片的路径）
	$src = "001.jpg";
	//2.获取图片信息（通过GD库提供的方法，得到你想要处理的图片的基本信息）
	$info = getimagesize($src);
	//3.通过图片编号获取图像的类型
	$type = image_type_to_extension($info[2],false);
	//4.在内存中创建一个和我们图像类型一样的图像
	$fun = "imagecreatefrom{$type}";
	//5.把图片复制到内存中
	$image = $fun($src);
//操作图片
	//1.设置字体的路径
	$font = "font.ttf";
	//2.填写水印内容
	$content = "hello world !";
	//3.设置字体的颜色和透明度 参数1 内存中的图片 
	$col = imagecolorallocatealpha($image, 255, 255, 255, 50);
	//4.写入文字
	imagettftext($image, 20, 0, 20, 30, $col, $font, $content);
//输出图片
	//浏览器输出
	header("Content-type:".$info['mime']);
	$func = "image{$type}";
	$func($image);
	//保存图片
	$func($image,"newimage.".$type);
//销毁图片
	imagedestroy($image);
?>