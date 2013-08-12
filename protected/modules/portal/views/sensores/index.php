<div class="span3">
    
    <?php $this->renderPartial('items_sidebar'); ?>
    
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
    
    <?php if(isset($_GET['id'])): ?>
   
        <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t("Gráfico de consulta Remota"),
            'headerIcon' => 'icon-list-alt',
            'headerButtons' => array(
                array(
                        'class' => 'bootstrap.widgets.TbButtonGroup',
                                'toggle' => 'radio',
                                'buttons'=>$buttons,
                        ),
            )
        )); ?>
    
                <?php $this->renderPartial($render,array('model'=>$model)); ?>
    
        <?php $this->endWidget(); ?>
    
    <?php endif; ?>
    
</div><!--/span-->
            
