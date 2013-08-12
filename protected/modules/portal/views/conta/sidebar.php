<div class="well sidebar-nav">

        <?php $this->widget('application.modules.portal.widgets.accountDetailsWidget',array('assetsurl'=>$this->module->assetsUrl)); ?>

</div><!--/.well -->

<hr>


<?php $this->widget('application.modules.portal.widgets.sidebarMenuWidget',array(
    'items'=>array(
        array('label'=>t('Definições de Conta'),
              'url'=>'/portal/conta/index',
              'icon'=>'icon-user'),
        array('label'=>t('Alterar Palavra Passe'),
              'url'=>'/portal/conta/password',
              'icon'=>'icon-lock'),
    ),
    'currentUrl'=>"/".$this->module->id."/".$this->ID."/".$this->action->id,
)); ?>
