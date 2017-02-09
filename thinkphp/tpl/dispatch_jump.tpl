{__NOLAYOUT__}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <link rel="stylesheet" type="text/css" href="/thinkphp/public/static/css/mdialog.css">
    <style type="text/css">
        *{ padding: 0; margin: 0; }
        body{ background: #fff; font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif; color: #333; font-size: 16px; }
        .system-message{ padding: 24px 48px; }
        .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
        .system-message .jump{ padding-top: 10px; }
        .system-message .jump a{ color: #333; }
        .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px; }
        .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display: none; }
    </style>
</head>
<body>


    <div class="system-message">
        <?php switch ($code) {?>
            <?php case 1:?>
            <div id="animationTipBox" style="width: 250px; height: 206px; margin-left: -125px; margin-top: -300px;">
                <div class="success">
                    <div class="icon">
                        <div class="line_short"> </div>
                        <div class="line_long"></div>  
                    </div> 
                    <div class="dec_txt"><?php echo(strip_tags($msg));?></div>
                </div>
               <div class="jump">页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b></div>
            </div>

            <?php break;?>
            <?php case 0:?>
            <div id="animationTipBox" style="width: 250px; height: 206px; margin-left: -125px; margin-top: -300px;">
                <div class="lose">
                    <div class="icon">
                        <div class="icon_box">
                            <div class="line_left"></div> 
                            <div class="line_right"></div>
                        </div>
                    </div>
                    <div class="dec_txt"><?php echo(strip_tags($msg));?></div>
                </div>
               <div class="jump">页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b></div>
            </div>

            <?php break;?>
        <?php } ?>
        <p class="detail"></p>

    </div>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),
                href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>
</body>
</html>
