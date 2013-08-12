<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-home icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title' => t('Unidades'),
                'headerIcon' => 'icon-list-alt',
                'headerButtons' => array(
                    array('class' => 'bootstrap.widgets.TbButtonGroup',
                            'buttons'=>array(
                                    array('label'=>t('Nova Unidade'), 
                                          'url'=> $this->createUrl('/portal/definicoes/index/action/new/'),))
                            ),
                    ),
            )); ?>
    
        <div class="nova-unidade" <?php echo (isset($_GET['action']))? '':'style="display: none;"';?>>
            
            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'nova-unidade',
                'type'=>'horizontal',
            )); ?>
            
                <?php echo $form->textFieldRow($model, 'IDENTIFICACAO'); ?>
            
                <?php echo $form->dropDownListRow($model,'TVALOR', array('int'=>t('Inteiro'),'float'=>t('Decimal'))); ?>
            
                <div class="form-actions">
                    <button type="submit" class="btn">Gravar</button>
                    <a href="<?php echo $this->createUrl('/portal/definicoes/index/'); ?>" class="btn" >Cancelar</a>
                </div>
            
            <?php $this->endWidget();?>
        </div>
    
        <?php if(!isset($_GET['action'])): ?>
    
            <?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
                    'fixedHeader' => true,
                    'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
                    'type' => 'striped',
                    'dataProvider' => $dataProvider,
                    'responsiveTable' => true,
                    'template' => "{items}",
                    'columns' => array(
                                    array('name'=>'ID_UNI',
                                      'type'=>'raw',
                                      'value'=>'$data->ID_UNI',
                                    ),
                                    array('name'=>'IDENTIFICACAO',
                                      'type'=>'raw',
                                      'value'=>'$data->IDENTIFICACAO',
                                    ),
                                    array('name'=>'TVALOR',
                                      'type'=>'raw',
                                      'value'=>'$data->TVALOR',
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
                                                'url'=>'Yii::app()->createUrl("/portal/definicoes/index/action/edit", array("id"=>$data->ID_UNI))',
                                                'options'=>array(
                                                    'class'=>'btn btn-small update'
                                                )
                                            )
                                        ),
                                        'deleteConfirmation'=>t('Tem a Certeza que deseja eliminar este Item?'),
                                )
                    )
            )); ?>
    
        <?php endif; ?>
    
    <?php $this->endWidget();?>
    
</div><!--/span-->
            
