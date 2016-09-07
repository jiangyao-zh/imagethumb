<?php
/**
 * PHP图片动态输出（JPG/PNG/GIF）
 * @param string $soure 图片相对路径地址
 * @param int $width 输出后宽度
 * @param int $heigh 输出后高度 
 * @return string $type 图片类型（image/png，image/jpeg，image/gif） 
 */
function imagethumb($soure,$width,$heigh,$type){
	// 设置图片输出输出类型
	header('Content-type: '.$type); 
	// 根据文件和不同类型创建一个新图象
	if($type == "image/png"){
		$im = @imagecreatefrompng($soure);
	}elseif($type == "image/jpeg"){
		$im = @imagecreatefromjpeg($soure);
	}elseif($type == "image/gif"){
		$im = @imagecreatefromgif($soure);
	}	
	// 返回一个图像标识符，代表了一幅大小为 x_size 和 y_size 的黑色图像	
	$thumb = imagecreatetruecolor($width,$heigh);
	// 设置标记以在保存 PNG 图像时保存完整的 alpha 通道信息（与单一透明色相反）
	imagesavealpha($im,true);
	$BigWidth=imagesx($im);
	$BigHeigh=imagesy($im);	
	imagealphablending($thumb,false);
	imagesavealpha($thumb,true);
	// 拷贝部分图像并调整大小
	imagecopyresized($thumb,$im,0,0,0,0,$width,$heigh,$BigWidth,$BigHeigh);	
	// 将图像输出到浏览器或文件
	if($type == "image/png"){
		imagepng($thumb);
	}elseif($type == "image/jpeg"){
		imagejpeg($thumb);
	}elseif($type == "image/gif"){		
		imagegif($thumb);
	}		
}
// 调用示例
imagethumb("info.png",50,50,"image/png");
?>
