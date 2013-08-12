<?php
$this->menu=array(
	array('label'=>t('Listar Menus'),'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'NOME',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php echo CHtml::submitButton(t('Seguinte'),array('class'=>'bebutton')); ?>
	</div>

<?php $this->endWidget(); ?>
