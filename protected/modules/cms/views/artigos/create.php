<?php
$this->menu=array(
	array('label'=>t('Listar Artigos'),'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
);
?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'objeto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'ESTADO', Helper::getEstadosArray()); ?>

	<div class="form-actions">
		<?php echo CHtml::submitButton(t('Seguinte'),array('class'=>'bebutton')); ?>
	</div>


<?php $this->endWidget(); ?>