<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cmsuser-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NOME'); ?>
		<?php echo $form->textField($model,'NOME',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'NOME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMAIL'); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'EMAIL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USERNAME'); ?>
		<?php echo $form->textField($model,'USERNAME',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'USERNAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PASSWORD'); ?>
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>60,'maxlength'=>150,'value'=>'')); ?>
		<?php echo $form->error($model,'PASSWORD'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? t('Adicionar') : t('Gravar'),array('name'=>'save','class'=>'bebutton')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->