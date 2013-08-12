<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt-PT" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="<?php echo $this->module->assetsUrl; ?>/images/icon.png">
        
        <!--[if lte IE 8]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/screen.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/print.css"/>

        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/form.css"/>

        <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/custom.js"></script>
        

    </head>
    <body>
    	<div class="container" id="page">
			<div id="header-login" style="margin:0 auto; text-align: center">		
				<div style="padding-top:60px">
				<img src="<?php echo $this->module->assetsUrl; ?>/images/logo.png">
				</div>
			</div>
			<div id="site-content" style="margin:0 auto; width:400px; border-top:0px">
      	
	      		<?php echo $content; ?>
        	</div>

		</div>
    </body>
</html>