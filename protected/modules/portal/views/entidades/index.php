<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-user icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink'=>false,
        'links'=>array(t('Dashboard')=>$this->createUrl('/portal/'),
                       $this->pageTitle),
    )); ?>
    
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'×', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true,), // success, info, warning, error or danger
        ),
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
                    array('name'=>'ID_ENT',
                          'type'=>'raw',
                          'value'=>'$data->ID_ENT',
                        ),
                    array('name'=>'NOME',
                          'type'=>'raw',
                          'value'=>'$data->NOME',
                        ),
                    array('name'=>'EMAIL',
                          'type'=>'raw',
                          'value'=>'$data->EMAIL',
                        ),
                    array('name'=>'LOCALIDADE',
                          'type'=>'raw',
                          'value'=>'$data->LOCALIDADE',
                        ),
                    array('name'=>'TELEFONE',
                          'type'=>'raw',
                          'value'=>'$data->TELEFONE',
                        ),
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions' => array('nowrap'=>'nowrap'),
                            'template' => '{update} {delete}',
                            'buttons' => array(
                                'delete' => array(
                                    'options'=>array(
                                        'class'=>'btn btn-small delete'
                                    )
                                ),
                                'update' => array(
                                    'options'=>array(
                                        'class'=>'btn btn-small update'
                                    )
                                )
                            ),
                            'deleteConfirmation'=>t('Tem a Certeza que deseja eliminar este Item?'),
                    )
                ),
        ));?>
        
    <?php $this->endWidget();?>
    
</div><!--/span-->