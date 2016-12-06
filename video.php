<?php require_once(dirname(__FILE__).'/include/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html><head>
        <title>艾路群控视频</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <video style="position: absolute;z-index: 1;width: 100%;height: 100%;" src="<?php echo $cfg_video; ?>" loop="" autobuffer="" autoplay=""></video>
    

</body></html>