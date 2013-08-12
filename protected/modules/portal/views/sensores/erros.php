<div class="span3">
    
    <?php $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-home icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink'=>false,
        'links'=>$this->breadcrumbs,
    )); ?>
    
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title' => t('Erros de Sensor'),
                'headerIcon' => 'icon-list-alt',
                'headerButtons' => array(
                    array(
                            'class' => 'bootstrap.widgets.TbButtonGroup',
                                    'toggle' => 'radio',
                                    'buttons'=>$buttons,
                            ),
                )
            )); ?>
    
        <?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
                'fixedHeader' => true,
                'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
                'type' => 'striped',
                'dataProvider' => $dataProvider,
                'responsiveTable' => true,
                'template' => "{items}",
                'columns' => $columns
        ));?>
    
    <?php $this->endWidget(); ?>
    
</div><!--/span-->
            
