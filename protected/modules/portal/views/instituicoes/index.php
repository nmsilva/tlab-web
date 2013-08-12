<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-home icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
     <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink'=>false,
        'links'=>array(t('Dashboard')=>$this->createUrl('/portal/'),
                       $this->pageTitle),
    )); ?>
        
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => t('Entidades'),
        'headerIcon' => 'icon-list-alt',
    )); ?>
        
         <?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
                'fixedHeader' => true,
                'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
                'type' => 'striped',
                'dataProvider' => $dataProvider,
                'responsiveTable' => true,
                'template' => "{items}",
                'columns' => array(
                    array('name'=>'ID_INST',
                          'type'=>'raw',
                          'value'=>'$data->ID_INST',
                        ),
                    array('name'=>'IDENTIFICACAO',
                          'type'=>'raw',
                          'value'=>'$data->IDENTIFICACAO',
                        ),
                ),
        ));?>
        
    <?php $this->endWidget();?>
    
    
</div><!--/span-->
            
