<div class="well sidebar-nav">

        <?php $this->widget('application.modules.portal.widgets.accountDetailsWidget',array('assetsurl'=>$this->module->assetsUrl)); ?>

</div><!--/.well -->

<hr>

<?php if(havePermission(user()->rule)): ?>

    <?php $this->widget('application.modules.portal.widgets.sidebarMenuWidget',array(
        'items'=>array(
            array('label'=>t('Unidades de Sensores'),
                  'url'=>'/portal/definicoes/index',
                  'icon'=>'icon-wrench'),
        ),
        'currentUrl'=>"/".$this->module->id."/".$this->ID."/".$this->action->id,
    )); ?>

<?php else: ?>

    <?php $this->widget('application.modules.portal.widgets.sidebarMenuWidget',array(
        'items'=>array(
            array('label'=>t('Consultar Sensores'),
                  'url'=>'/portal/sensores/index',
                  'icon'=>'icon-list'),
            array('label'=>t('Gerar Relatório'),
                  'url'=>'/portal/relatorios/index',
                  'icon'=>'icon-file'),
            array('label'=>t('Sair'),
                  'url'=>'/portal/dashboard/logout',
                  'icon'=>'icon-off'),
        ),
        'currentUrl'=>"/".$this->module->id."/".$this->ID."/".$this->action->id,
    )); ?>

<?php endif; ?>
