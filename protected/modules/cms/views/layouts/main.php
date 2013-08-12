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
        

        <style>
            .items input{padding: 4px 0;}
        </style>

    </head>
    <body>
        <div class="container" id="page">
            <div id="language-bar" style="text-align: right; padding:5px 10px 5px 0px">
                <?php   //shortcut
                $translate=Yii::app()->translate;               
                if($translate->hasMessages()){      
                  echo $translate->translateLink(t('Traduzir Página'))."|";                  
                }       
                echo $translate->editLink(t('Gerir Traduções'))."|";       
                echo $translate->missingLink(t('Mudar Traduções'));
                
                
                ?>
            </div>
            <div id="nav">
                <div class="wrap">

                        <ul class="left">
                            <li><a href="<?php echo $this->createUrl("/site"); ?>" id="visit_site" target="_blank"><?php echo t('Visitar WebSite'); ?></a></li>                  
                        </ul>

                        <ul class="right">
                                <li>
                                    <?php                                               
                                    $translate=Yii::app()->translate;
                                    echo $translate->dropdown();                                                                                       
                                     ?>
                                &nbsp;</li>
                            <li><?php echo t('Bem Vindo'); ?>, <strong><?php echo user()->name; ?></strong>&nbsp;|&nbsp;</li>
                            <li><a href="<?php echo Yii::app()->request->baseUrl?>/beuser/updatesettings"><?php echo t('Opções'); ?></a>&nbsp;|&nbsp;</li>
                            <li><a href="<?php echo Yii::app()->request->baseUrl?>/beuser/changepass"><?php echo t('Alterar Password'); ?></a>&nbsp;|&nbsp;</li>
                            <li><a href="<?php echo $this->createUrl('dashboard/logout'); ?>"><?php echo t('Sair'); ?></a></li>
                        </ul>
                        
                </div>
                    
            </div>
            <div id="header">
                <div style="float:left; padding-left:45px">
                <a href="<?php echo bu().'/cms'; ?>"><img src="<?php echo $this->module->assetsUrl; ?>/images/logo_small.png"; /></a>
                </div>
                <form id="search-box" method="get" action="#" style="float:left;">
                    <input class="topSearchBox" id="topSearchBox" autocomplete="off" type="text" maxlength="2048" name="q" label="Search" placeholder="" aria-haspopup="true" />
                    <input type="submit" value="<?php echo t('Go'); ?>" id="searchbutton" class="bebutton" />
                </form>
                <div class="clear"></div>
            </div>
            <div id="site-content">
                <div id="left-sidebar">
                            
                            <?php
                    $this->widget('zii.widgets.CMenu',array(
                    'encodeLabel'=>false,
                    'activateItems'=>true,
                    'activeCssClass'=>'list_active',
                    'items'=>array(
                            array('label'=>'<span id="menu_dashboard" class="micon"></span>'.t('Dashboard'), 'url'=>array('/cms/') ,'linkOptions'=>array('class'=>'menu_0'),
                                'active'=> ((Yii::app()->controller->id=='dashboard') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
                                ),                               
                            array('label'=>'<span id="menu_content" class="micon"></span>'.t('Conteúdo'),  'url'=>'javascript:void(0);','linkOptions'=>array('class'=>'menu_1' ), 'itemOptions'=>array('id'=>'menu_1'), 
                                'items'=>array(
                                    array('label'=>t('Artigos'), 'url'=>array('/cms/artigos'),
                                            'active'=> ((Yii::app()->controller->id=='artigos') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index','create'))) ? true : false)),
                                    array('label'=>t('Categorias'), 'url'=>array('/cms/categorias'),
                                            'active'=> ((Yii::app()->controller->id=='categorias') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index','create'))) ? true : false)),

                                )),
                            array('label'=>'<span id="menu_page" class="micon"></span>'.t('Paginas'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_3'),
                                'items'=>array(
                                    array('label'=>t('Menus'), 'url'=>array('/cms/menus'),
                                            'active'=> ((Yii::app()->controller->id=='menus') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index','create'))) ? true : false)),
                                    array('label'=>t('Idiomas'), 'url'=>array('/cms/idiomas'),
                                            'active'=> ((Yii::app()->controller->id=='idiomas') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index','create'))) ? true : false)),
                                )),
                            array('label'=>'<span id="menu_resource" class="micon"></span>'.t('Multimédia'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_4','class'=>'menu_4'), 'itemOptions'=>array('id'=>'menu_4'), 
                                'items'=>array(
                                    array('label'=>t('Adicionar Multimédia'), 'url'=>array('/cms/media/create')),
                                    array('label'=>t('Gerir Multimédia'), 'url'=>array('/cms/media'),
                                         'active'=> ((Yii::app()->controller->id=='media') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false),
                                    array('label'=>t('Galerias'), 'url'=>array('/cms/galerias'),
                                         'active'=> ((Yii::app()->controller->id=='galerias') && (in_array(Yii::app()->controller->action->id,array('create','update','admin','index')))) ? true : false)
                                )),
                            array('label'=>'<span id="menu_user" class="micon"></span>'.t('Utilizadores'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_6','class'=>'menu_6'), 'itemOptions'=>array('id'=>'menu_6'), 
                                'items'=>array(
                                array('label'=>t('Criar Utilizador'), 'url'=>array('/cms/users/create')),
                                array('label'=>t('Gerir Utilizadores'), 'url'=>array('/cms/users/'),
                                      'active'=> ((Yii::app()->controller->id=='users') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false
                                      ),
                                ),  
                            ),
                            array('label'=>'<span id="menu_dashboard" class="micon"></span>'.t('Opções'), 'url'=>array('/cms/opcoes') ,'linkOptions'=>array('class'=>'menu_7'),
                                'active'=> ((Yii::app()->controller->id=='opcoes') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
                                ),
                           array('label'=>'<span id="menu_caching" class="micon"></span>'.t('Caching'), 'url'=>array('/cms/cache'),'linkOptions'=>array('id'=>'menu_8','class'=>'menu_8'), 'itemOptions'=>array('id'=>'menu_8'), 
                                 'active'=> ((Yii::app()->controller->id=='cache') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false 
                                ),
                            
                        ),
                    )); ?>
                
                </div>
                <div id="main-content-zone">
                    <?php if(isset($this->menu)) :?>
                        <?php if(count($this->menu) >0 ): ?>
                            <div class="header-info">
                                <?php $this->widget('zii.widgets.CMenu', array(
                                                'items'=>$this->menu,
                                                'htmlOptions'=>array(),
                                        ));
                                       
                                ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="page-content">                                
                        <h2><?php echo (isset($this->titleImage)&&($this->titleImage!=''))? '<img src="'.$backend_asset.'/'.$this->titleImage.'" />' : ''; ?><?php echo isset($this->pageTitle)? $this->pageTitle : '';  ?></h2>
                        <?php if (isset($this->pageHint)&&($this->pageHint!='')) : ?>
                            <p><?php echo $this->pageHint; ?></p>
                        <?php endif; ?>

                        <?php echo $content; ?>

                    </div>
                </div>
                <div class="clear"></div>
            </div>

        </div><!-- page -->
            <script type="text/javascript">

            $(document).ready(function () {
                    //Hide the second level menu
                    $('#left-sidebar ul li ul').hide();            
                    //Show the second level menu if an item inside it active
                    $('li.list_active').parent("ul").show();
                    
                    $('#left-sidebar').children('ul').children('li').children('a').click(function () {                    
                        
                         if($(this).parent().children('ul').length>0){                  
                            $(this).parent().children('ul').toggle();    
                         }
                         
                    });
                  
                    
                });
            </script>
    </body>
</html>