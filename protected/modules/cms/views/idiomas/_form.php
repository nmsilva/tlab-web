<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'idioma-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<div class="form-wrapper">
    <div id="form-sidebar">
            <div class="closed-box content-box">
                <div class="content-box-header">
                    <h3><?php echo t('Bandeira');?></h3>                             
                </div> 
                <div class="content-box-content" style="display: block;">
                        <div class="tab-content default-tab" id="extra_box">

                                
                        </div>                                     
                </div>
        </div>
    </div>
    <div id="form-body">
            <div id="form-body-content">

                    <div class="closed-box content-box">
                            <div class="content-box-header">
                                <h3><?php echo t('Dados Gerais');?></h3>                             
                            </div> 
                            <div class="content-box-content" style="display: block;">

                                    <div class="tab-content default-tab" id="extra_box">
                                        <?php echo $form->errorSummary($model); ?>

                                        <?php echo $form->textFieldRow($model,'NOME',array('class'=>'span5','maxlength'=>255)); ?>

                                        <?php echo $form->textFieldRow($model,'DESCRI',array('class'=>'span5','maxlength'=>255)); ?>
                                        
                                        <?php if(!$model->isNewRecord): ?>
                                                 <?php echo CHtml::image(Yii::app()->getAssetManager()->publish($this->dir."/".$model->BANDEIRA),"image"); ?> 
                                        <?php endif; ?>
                                        
                                        <?php echo $form->labelEx($model,'BANDEIRA'); ?>
                                        <?php echo CHtml::activeFileField($model, 'BANDEIRA'); ?>  
                                        <?php echo $form->error($model,'BANDEIRA'); ?>
        
                                        
                                        <?php echo $form->dropDownListRow($model,'ESTADO', Helper::getEstadosArray()); ?>

                                        <?php echo $form->textFieldRow($model,'SHORT',array('class'=>'span5','maxlength'=>50)); ?>

                                        <?php echo $form->dropDownListRow($model,'REQUIRED',Helper::getObrigatorioArray()); ?>
                                    </div>                                     
                            </div>
                    </div>


                    <div class="form-actions">
                            <?php echo CHtml::submitButton(t($model->isNewRecord ? t('Adicionar') : t('Gravar')),array('name'=>'save','class'=>'bebutton')); ?>
                    </div>

        </div>

    </div>
        
</div>
    
<?php $this->endWidget(); ?>
