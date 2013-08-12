<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt-PT" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>        
        <?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
            'httpEquivs'=>array(
                'Content-Type'=>'text/html; charset=utf-8',
                'Content-Language'=> Yii::app()->language
            ),
        )); ?>
        
        <link rel="shortcut icon" href="<?php echo $this->module->assetsUrl; ?>/images/icon.png">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            
        <!--[if lte IE 8]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
                
<!--        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/reset.css" media="screen" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/style.css" media="screen" />
        <link href="<?php echo $this->module->assetsUrl; ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet"/>
        
        <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/jquery.treeview.css" />
        
        <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.treeview.js" type="text/javascript"></script>
        
    </head>
    <body style="background-image: url(<?php echo $this->module->assetsUrl; ?>/images/body-bg.png); background-position: 0px 0px; background-repeat: repeat repeat;">
        
        
        <?php if(user()->rule==1): ?>
            <?php $this->renderPartial('/layouts/menu/admin'); ?>
        <?php elseif(user()->rule==2): ?>
            <?php $this->renderPartial('/layouts/menu/tecnicos'); ?>
        <?php elseif(user()->rule==3): ?>
            <?php $this->renderPartial('/layouts/menu/clientes'); ?>
        <?php endif; ?>
        
        <div class="container">
          <div class="row-fluid">
              
            <?php echo $content; ?>
              
          </div><!--/row-->

          <hr>

          <footer>
            <p>© tLab - Engidom <?php echo date('Y');?></p>
          </footer>

        </div><!--/.fluid-container-->


        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type='text/javascript' src='<?php echo $this->module->assetsUrl; ?>/js/custom.js'></script>

    </body>
</html>