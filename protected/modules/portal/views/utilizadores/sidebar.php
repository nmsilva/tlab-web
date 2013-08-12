<div class="well sidebar-nav">

        <?php $this->widget('application.modules.portal.widgets.accountDetailsWidget',array('assetsurl'=>$this->module->assetsUrl)); ?>

</div><!--/.well -->

<hr>


<?php $this->widget('application.modules.portal.widgets.sidebarMenuWidget',array(
    'items'=>array(
        array('label'=>t('Criar Conta'),
              'url'=>'/portal/utilizadores/create',
              'icon'=>'icon-user'),
        array('label'=>t('Listar Utilizadores'),
              'url'=>array('/portal/utilizadores/index',
                           '/portal/utilizadores/update'),
              'icon'=>'icon-list'),
    ),
    'currentUrl'=>"/".$this->module->id."/".$this->ID."/".$this->action->id,
)); ?>
