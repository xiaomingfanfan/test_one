<?php
class Image{
	/**
	 * $info 图片基本信息
	 * $image 图片
	 * $angle 水印旋转角度
	 * $font 选择水印字体
	 */
	private $info;
	private $image;
	public $angle=0;
	public $font="font.ttf";

	/**
	 * 打开图片
	 */
	public function __construct($src){
		$info = getimagesize($src);
		$this->info = array(
			'width'=>$info[0],
			'height'=>$info[1],
			'type'=>image_type_to_extension($info[2],false),
			'mime'=>$info['mime']
			);
		$fun = "imagecreatefrom{$this->info['type']}";
		$this->image =  $fun($src);
	}
	
	/**
	 * 文字水印
	 */
	public function fontMark($content,$loca,$size=20,$color=array(0 => 255, 1=>255,2=>255,3=>50)){
		$col = imagecolorallocatealpha($this->image, $color[0], $color[1], $color[2], $color[3]);
		imagettftext($this->image, $size, $this->angle, $loca['x'], $loca['y'], $col, $this->font, $content);
	}

	/**
	 * 图片水印
	 */
	public function imageMark(){

	}

	/**
	 * 压缩图片
	 */
	public function thumb($width,$height){
		$image_thumb = imagecreatetruecolor($width, $height);
		imagecopyresampled($image_thumb, $this->image, 0, 0, 0, 0, $width, $height, $this->info['width'],  $this->info['height']);
		imagedestroy($this->image);
		$this->image = $image_thumb;
	}

	/**
	 * 显示图片
	 */
	public function show(){
		header("Content-type:".$this->info['mime']);
		$func = "image{$this->info['type']}";
		// var_dump($func);exit;
		$func($this->image);
	}

	/**
	 * 保存图片
	 */
	public function save($newname){
		$func = "image{$this->info['type']}";
		$func($this->image,$newname.'.'.$this->info['type']);
	}

	/**
	 * 销毁图片
	 */
	public function __destruct(){
		imagedestroy($this->image);
	}
}
?>