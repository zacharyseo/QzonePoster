<?php
/****************
*
**为你一人 wnyr.pw
*
*****************/
header("content-type:text/html; charset=utf-8");
function cpost($url,$post){
	$ch= curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);       
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1'); 
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
	curl_setopt($ch, CURLOPT_POST, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
} 
 
function surl($content="wnyr",$sid,$qq,$sname,$richval,$lon="",$lat=""){
	$url='http://m.qzone.com/mood/publish_mood';
	$post='content='.$content.'++&sid='.$sid.'&lon='.$lon.'&lbsid=&res_uin='.$qq.'&richval='.urlencode($richval).'&source_name='.$sname.'&is_winphone=2&opr_type=publish_shuoshuo&format=json&issyncweibo=0&lat='.$lat;
	return cpost($url,$post);
}
 
echo <<<HTML
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title>说说</title>
    <!--baidu-->
    <meta name="baidu-site-verification" content="4IPJiuihDj" />
    <!-- Bootstrap -->
    <link href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	body{
		margin: 0 auto;
		text-align: center;
	}
	.container {
	  max-width: 580px;
	  padding: 15px;
	  margin: 0 auto;
	}
	</style>
</head>
<body>
<div class="container">
<div class="header">
<h3 class="text-muted" align="container">说说</h3></div><hr>
<form action="qzone.php" class="form-horizontal" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">QQ</label>
    <div class="col-sm-10">
		<input type="text" class="form-control" name="qq" value="">
	</div>
</div>
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">SID</label>
    <div class="col-sm-10">
		<input type="text" class="form-control" name="sid" value="">
	</div>
</div>
		
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">机型</label>
    <div class="col-sm-10">
		<input type="text" class="form-control" name="sname" value="iPhone 6 Plus">
	</div>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">内容</label>
    <div class="col-sm-10">
		<input type="text" class="form-control" name="content" value="_linmi">
	</div>
</div>
		
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">经度</label>
    <div class="col-sm-10">
		<input type="text" class="form-control" name="lon" placeholder="经度lon">
	</div>
</div>
		
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">纬度</label>
    <div class="col-sm-10">
		<input type="text" class="form-control" name="lat" placeholder="纬度lat">
	</div>
</div>
		
<div class="form-group">
    <label for="file" class="col-sm-2 control-label">图片</label>
    <div class="col-sm-10">
		<input type="file" class="form-control" name="file" id="file" /> 
	</div>
</div>

<div class="form-group">
	<label for="file" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
		<input type="submit" class="btn btn-primary btn-block" name="submit" value="发布">
	</div>
</div>
</body>
</html>
HTML;
	$qq=$_POST["qq"];
	$sid=$_POST["sid"];
	$sname=$_POST["sname"];
	$content=$_POST["content"];
	$lon=$_POST["lon"];
	$lat=$_POST["lat"];
if((!empty($sid))&&(!empty($qq))){
	$file = realpath($_FILES["file"]["tmp_name"]);
	$image_size = getimagesize($file); 
	$image=file_get_contents($file);
	$url="http://up.qzone.com/cgi-bin/upload/cgi_upload_pic_v2";
	$post="picture=".urlencode(base64_encode($image))."&base64=1&hd_height=".$image_size[1]."&hd_width=".$image_size[0]."&hd_quality=90&output_type=json&preupload=1&charset=utf-8&output_charset=utf-8&logintype=sid&Exif_CameraMaker=&Exif_CameraModel=&Exif_Time=&uin=".$qq."&sid=".$sid;
	$data=preg_replace("/\s/","",cpost($url,$post));
	preg_match('/_Callback\((.*)\);/',$data,$arr);
	$data=json_decode($arr[1],true);
	$post="output_type=json&preupload=2&md5=".$data[filemd5]."&filelen=".$data[filelen]."&batchid=".time().rand(100000,999999)."&currnum=0&uploadNum=1&uploadtime=".time()."&uploadtype=1&upload_hd=0&albumtype=7&big_style=1&op_src=15003&charset=utf-8&output_charset=utf-8&uin=".$qq."&sid=".$sid."&logintype=sid&refer=shuoshuo";
	$img=preg_replace("/\s/","",cpost($url,$post));
	preg_match('/_Callback\(\[(.*)\]\);/',$img,$arr);
	$data=json_decode($arr[1],true);
	$richval=($data[picinfo][albumid]!="")?"{$data[picinfo][albumid]},{$data[picinfo][lloc]},{$data[picinfo][sloc]},{$data[picinfo][type]},{$data[picinfo][height]},{$data[picinfo][width]},,,":"";
	$result=surl($content,$sid,$qq,$sname,$richval,$lon,$lat);
	$result=json_decode($result,true);
	if($result[code]==0) echo "发布成功";
	else echo "发布异常";
}
