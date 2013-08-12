<div class="well sidebar-nav">

        <?php $this->widget('application.modules.portal.widgets.accountDetailsWidget',array('assetsurl'=>$this->module->assetsUrl)); ?>

</div><!--/.well -->

<hr>


<?php $this->widget('application.modules.portal.widgets.sidebarMenuWidget',array(
    'items'=>array(
        array('label'=>t('Adicionar Entidade'),
              'url'=>'/portal/entidades/create',
              'icon'=>'icon-user'),
        array('label'=>t('Listar Entidades'),
              'url'=>array('/portal/entidades/index',
                           '/portal/entidades/update',
                           '/portal/instituicoes/create',
                           '/portal/instituicoes/update'),
              'icon'=>'icon-list'),
    ),
    'currentUrl'=>"/".$this->module->id."/".$this->ID."/".$this->action->id,
)); ?>
