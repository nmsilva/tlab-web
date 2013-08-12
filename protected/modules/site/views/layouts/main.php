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
        
                
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/style.css" media="screen" />
        <link href="<?php echo $this->module->assetsUrl; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <link href="<?php echo $this->module->assetsUrl; ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/link-button.css" type="text/css" media="screen" title="no title" charset="utf-8"/>    
       
        <!--<script type='text/javascript' src='<?php echo $this->module->assetsUrl; ?>/js/jquery.js'></script>-->
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

    </head>
    <body>
        
        <?php if(isset(user()->type) and user()->type == CMS_STATE): ?>
        
<!--            <div id="language-bar" style="text-align: right; padding:5px 10px 5px 0px;background: #fff;">
                    <?php   //shortcut
                    $translate=Yii::app()->translate;               
                    if($translate->hasMessages()){      
                      echo $translate->translateLink(t('Traduzir Página'))."|";                  
                    }       
                    echo $translate->editLink(t('Gerir Traduções'))."|";       
                    echo $translate->missingLink(t('Mudar Traduções'));


                    ?>
            </div>-->
        <?php endif; ?>
        
        <!-- begin header-->
        <header>
            
            <!-- begin wrapper-->
            <section class="wrapper">
                
                <div id="menu-container">
                    <div id="logo">
                        <a href="<?php echo $this->createUrl('/site/front'); ?>"><img src="<?php echo $this->module->assetsUrl; ?>/images/logo.png" alt=""></a>
                    </div>
                    <div id="mainmenu">
                        <?php $this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('id'=>'menu',),
                            'items'=>Menu::model()->getItems('8',$this->lang)
                        )); ?>
                        <div id="languages">
                            <?php $this->widget('application.modules.site.components.LanguageMenuWidget',array('lang'=>$this->lang)); ?>
                        </div>
                        <div>
                            <div id="login-wrapper">
                                <a class="link-button green" href="<?php echo $this->createUrl('front/entrar'); ?>"><span>Entrar</span></a>                        
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

            </section>
            <!-- end wrapper-->
            
        </header>
        <!-- end header-->
        
        <?php echo $content; ?>
        
        <!-- begin footer-->
        <footer>
            <!-- begin wrapper-->
            <section class="wrapper">
                <div id="bottom-content">
                    <div class="row">
                        <div class="logofooter-column span2">
                            <img src="<?php echo $this->module->assetsUrl; ?>/images/logo-footer.png" alt="" class="footerlogo">
                        </div>
                        <div class="contactbottom-column span2">
                            <h6>Quem Somos</h6>
                            <p><a href="#">Que é o tLab?</a><br>
                            <a href="#">Testemunhos</a><br>
                            <a href="#">Contactos</a><br>
                        </div>
                        <div class="contactbottom-column span2">
                            <h6>Como obter</h6>
                            <p><a href="#">Fale Conosco</a><br>
                            <a href="#">Seja um parceiro</a></p>
                        </div>
                        <div class="contactbottom-column span2">
                            <h6>Recursos</h6>
                            <p><a href="#" target="_blank">Ajuda<br>
                            </a></p>
                        </div>
                        <div class="contactbottom-column span2">
                            <h6>Siga-nos</h6>
                            <p><a href="#" target="_blank">
                                    <img  title="fb" src="<?php echo $this->module->assetsUrl; ?>/images/fb.png" alt="" width="24" height="24">
                                </a>&nbsp;
                                <a href="#" target="_blank">
                                    <img title="in" src="<?php echo $this->module->assetsUrl; ?>/images/in.png" alt="" width="24" height="24">
                                </a><br>
                                <a href="#" target="_blank">
                                    <img title="tw" src="<?php echo $this->module->assetsUrl; ?>/images/tw.png" alt="" width="24" height="24">
                                </a> &nbsp;
                                <a href="#" target="_blank">
                                    <img title="yo" src="<?php echo $this->module->assetsUrl; ?>/images/yo.png" alt="" width="24" height="24">
                                </a></p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end wrapper-->
            
        </footer>
        <!-- end footer-->
        
        <div id="creditos-container">
             <!-- begin wrapper-->
            <section class="wrapper">
                <span>© 2013 Engidom - Rua Ponte de Pau, 19 - R/C / <a href="#">Termos de Utilização</a>-<a href="#">Politica de Privacidade</a></span>
            </section>
            <!-- end wrapper-->
        </div>
        
        
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type='text/javascript' src='<?php echo $this->module->assetsUrl; ?>/js/custom.js'></script>
        <script src="<?php echo $this->module->assetsUrl; ?>/bootstrap/js/bootstrap.min.js"></script>
        
        <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.columnizer.js" type="text/javascript" charset="utf-8"></script>
	<script>
		$(function(){
			$('.columns').columnize({
				columns : 2,
				accuracy : 1,
				buildOnce : true,
				target: "#target"
				
			});
		});
	</script>
        
    </body>
</html>