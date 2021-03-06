<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

//初始化参数检测正确性
$cid = empty($cid) ? 1 : intval($cid);
$id  = empty($id)  ? 0 : intval($id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="renderer" content="webkit" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<?php echo GetHeader(1,$cid,$id); ?>
<link rel="shortcut icon" id="favicon" href="/favicon.png" />
  
<link rel="stylesheet" href="css/main.css?v=17.24" /> 
<link rel="stylesheet" href="css/animation.css" /> 
</head> 
<body class="details-page open">
	  <?php

			//检测文档正确性
			$r = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE id=$id");
			if(@$r)
			{
			//增加一次点击量
			$dosql->ExecNoneQuery("UPDATE `#@__infoimg` SET hits=hits+1 WHERE id=$id");
			$row = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE id=$id");
			?>
<div id="main-container">
	<div class="inner-wrap">
		<div class="case-detail">
			<p class="caption">项目介绍</p>
			<h1>[<?php echo $row['title']; ?>]</h1><span class="info"><?php echo $row['keywords']; ?></span>
			<?php $row2 = $dosql->GetOne("SELECT * FROM `#@__infoclass` WHERE id=$cid"); ?>
			<div class="intro"><?php
				if($row['description'] != '')
					echo ReStrLen($row['description'],100);
				else
					echo '网站资料更新中...';
				?></div>
			<p class="caption"><?php echo $row2['classname']; ?></p> 
			<div class="imgs">
						<?php
				if($row['content'] != '')
					echo GetContPage($row['content']);
				else
					echo '网站资料更新中...';
				?></div> 
		</div> 
	</div>
	<ul class="btns">
		<li><a class="up"></a></li>
		<li><a class="tel" href="tel:<?php echo $cfg_hotline; ?>"></a>
			<div class="info"><p>咨询热线<br /><?php echo $cfg_hotline; ?></p></div>
		</li> 
		<li><a class="qq" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $cfg_qqcode; ?>&site=qq&menu=yes" target="_blank"></a>
			<div class="info"><p class="qq">点击我，在线咨询</p></div>
		</li>
	</ul>
</div>
<div class="sub-nav">
	<ul class="btn">
	<li><a href="case.php"><img src="img/home.png"><span style="margin-left:5px" class="yc"><?php echo GetCatName(1); ?></span></a></li>
	<?php
	
				//获取上一篇信息
				$r = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE classid=".$row['classid']." AND orderid<".$row['orderid']." AND delstate='' AND checkinfo=true ORDER BY orderid DESC");
				if($r < 1)
				{
				echo '<li>
        	    <a href="#"><span><img src="img/preno.png"></span></a></li>';
				}
				else
				{
					if($cfg_isreurl != 'Y')
						$gourl = 'show.php?cid='.$r['classid'].'&id='.$r['id'];
					else
						$gourl = 'show-'.$r['classid'].'-'.$r['id'].'-1.html';
echo ' <li><a href="'.$gourl.'"><span><img src="img/pre.png"></span></a></li>';
				}

				//获取下一篇信息
				$r = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE classid=".$row['classid']." AND orderid>".$row['orderid']." AND delstate='' AND checkinfo=true ORDER BY orderid ASC");
				if($r < 1)
				{
				echo '<li>
        	    <a href="#"><span><img src="img/nextno.png"></span></a></li>';
				}
				else
				{
					if($cfg_isreurl != 'Y')
						$gourl = 'show.php?cid='.$r['classid'].'&id='.$r['id'];
					else
						$gourl = 'show-'.$r['classid'].'-'.$r['id'].'-1.html';

					echo ' <li><a href="'.$gourl.'"><span><img src="img/next.png"></span></a></li>';
				}
				?>
	</ul>
</div> 

<aside class="main">
<h1><?php

		$dopage->GetPage("SELECT * FROM `pmw_imgtext` WHERE id=1");
		while($row = $dosql->GetArray())
		{
		?><a href="index.php"><img alt="logo图片" src="<?php echo $row['picurl']; ?>" width="100%" /></a><?php
		}
		?></h1>
<div class="qrcode aside-container"><?php

		$dopage->GetPage("SELECT * FROM `pmw_imgtext` WHERE id=10");
		while($row = $dosql->GetArray())
		{
		?><img src="<?php echo $row['picurl']; ?>" /><?php
		}
		?>
<p>扫一扫微信二维码<i></i></p>
</div>
<nav class="aside-container">
	<ul>
		<li><a href="/">网站首页</a></li>
		<li><a class="cur" href="case.php"><?php echo GetCatName(1); ?></a></li>
		<li><a href="news.php"><?php echo GetCatName(2); ?></a></li>
	</ul>
</nav>
   	<?php
			}
			?> 
<footer>
<?php echo $cfg_author; ?><br />
<?php echo $cfg_copyright; ?>
</footer>
</aside>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript">
	$(".sub-nav .switch").click(function(){ 
		if($('body').hasClass('open')){
			$(this).attr('data-icon',9);		
			$('body').removeClass('open').addClass('close');
		}else{
			$(this).attr('data-icon',8);
			$('body').removeClass('close').addClass('open');
		}
		
	});
	$(".btns .up").click(function(){ 
		$("html,body").animate({scrollTop:0},600);
	});
</script>
</body>
</html> 