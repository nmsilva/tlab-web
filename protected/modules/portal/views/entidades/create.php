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
                       t('Entidades')=>$this->createUrl('/portal/entidades/index'),
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
    
    <?php 
    $headerButtons=array();
    
    if(!$model->isNewRecord)
    {
        $headerButtons=array(
                array('class' => 'bootstrap.widgets.TbButtonGroup',
                        'buttons'=>array(
                                array('label'=>'Voltar', 'url'=> $this->createUrl('/portal/'.$this->ID.'/index'))
                        ),
                ),
            );
    }
    ?>
    
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'horizontalForm',
		'type'=>'horizontal',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)); ?>
    
        <?php if(!$model->isNewRecord): ?>

            <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Logotipo da Entidade'),
            'headerIcon' => 'icon-user',
            )); ?>
                <ul class="thumbnails" style="margin-bottom: 0;">
                <li>
                    <a class="thumbnail" onclick="return false;" href="#">
                        <?php if(!empty($model->LOGO)):?>
                            <img src="<?php echo Helper::getFotoPublicUrl()."/".$model->LOGO; ?>" width="80" height="80">
                        <?php else: ?>
                            <img id="image_normal" src="<?php echo $this->module->assetsUrl; ?>/images/user_80x80.jpg">
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
            <?php echo $form->fileField($foto, 'file'); ?>
            <p>Your picture can have a maximum size of 0.5 MB and these formats: jpeg, gif or png. You will get best result using a 100x100 pixel picture.</p>
            
            <?php $this->endWidget();?>
           
        <?php endif;?>
                
                
        <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Informação'),
            'headerIcon' => 'icon-list-alt',
        )); ?>
        
        
            <fieldset>
                
                <?php echo $form->textFieldRow($model, 'NOME',array('class'=>'span8')); ?>
                
                <?php echo $form->textFieldRow($model, 'EMAIL'); ?>
                
                <?php echo $form->textFieldRow($model, 'NIF'); ?>
                
                <?php echo $form->textFieldRow($model, 'LOCALIDADE'); ?>
                
                <?php echo $form->textFieldRow($model, 'COD_POSTAL'); ?>
                
                <?php echo $form->textFieldRow($model, 'RUA',array('class'=>'span8')); ?>
                
                <?php echo $form->textFieldRow($model, 'TELEFONE'); ?>
                
                <?php echo $form->textFieldRow($model, 'TELEMOVEL'); ?>
                
            </fieldset>
    
        <?php $this->endWidget(); ?>
        

        <?php if(!$model->isNewRecord): ?>
            
            <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title' => t('Instituições'),
                'headerIcon' => 'icon-list-alt',
                'headerButtons' => array(
                    array('class' => 'bootstrap.widgets.TbButtonGroup',
                            'buttons'=>array(
                                    array('label'=>t('Nova Instituição'), 
                                          'url'=> $this->createUrl('/portal/instituicoes/create/id/'.$model->ID_ENT)))
                            ),
                    ),
            )); ?>

                 <?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
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
                                            'url'=>'Yii::app()->createUrl("/portal/instituicoes/update", array("id"=>$data->ID_INST))',
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

        <?php endif; ?>
    
        <div class="form-actions" style="padding-left: 0;">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>t('Gravar'))); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>t('Cancelar'))); ?>
        </div>
    
    <?php $this->endWidget();?>
</div>

