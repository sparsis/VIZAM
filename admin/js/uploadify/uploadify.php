<?php 
 require_once('../../../dts/iniSis.php'); //CONECTAR AO SERVIDOR
 $conexao = mysql_connect(HOST, USER, PASS);
 $database = mysql_select_db(DB);
?>
<?php
if (!empty($_FILES)) {
	$postId		= $_POST['postId'];
    $img        = $_FILES['Filedata']['name'];
	$ext        = substr($img, -4);
	$img        = $postId.'-'.md5(uniqid(time())).$ext;
	$targetPath = $_SERVER['DOCUMENT_ROOT'].$_REQUEST['folder'].'/';
	$m = date('m');
	$y = date('Y');
	if(!file_exists($targetPath.$y)){ mkdir($targetPath.$y,0755);}
	if(!file_exists($targetPath.$y.'/'.$m)){ mkdir($targetPath.$y.'/'.$m,0755);}
	$targetPath = $_SERVER['DOCUMENT_ROOT'].$_REQUEST['folder'].'/'.$y.'/'.$m.'/';
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetFile =  str_replace('//','/',$targetPath).$img;
	
		$imgCad = $y.'/'.$m.'/'.$img;
		$timestamp = date('Y-m-d H:i:s');
		$cadastra = mysql_query("INSERT INTO posts_gb (post_id, img, data) VALUES('$postId','$imgCad', '$timestamp')");
}
	
	move_uploaded_file($tempFile,$targetFile);
	str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
	
	$imgsize = getimagesize($targetFile);
	switch(strtolower(substr($targetFile, -3))){
		case "jpg":
			$image = imagecreatefromjpeg($targetFile);    
		break;
		case "png":
			$image = imagecreatefrompng($targetFile);
		break;
		case "gif":
			$image = imagecreatefromgif($targetFile);
		break;
		default:
			exit;
		break;
	}
	
	$width = 940;  
	$height = $imgsize[1]/$imgsize[0]*$width;
	
	$src_w = $imgsize[0];
	$src_h = $imgsize[1];
	
	$picture = imagecreatetruecolor($width, $height);
	imagealphablending($picture, false);
	imagesavealpha($picture, true);
	$bool = imagecopyresampled($picture, $image, 0, 0, 0, 0, $width, $height, $src_w, $src_h); 
	
	if($bool){
		switch(strtolower(substr($targetFile, -3))){
			case "jpg":
				header("Content-Type: image/jpeg");
				$bool2 = imagejpeg($picture,$targetPath.$img,100);
			break;
			case "png":
				header("Content-Type: image/png");
				imagepng($picture,$targetPath.$img);
			break;
			case "gif":
				header("Content-Type: image/gif");
				imagegif($picture,$targetPath.$img);
			break;
		}
	}
	
		imagedestroy($picture);
		imagedestroy($image);
		echo '1';
?>