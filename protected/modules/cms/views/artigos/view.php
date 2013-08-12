<?php
$this->breadcrumbs=array(
	'Objetos'=>array('index'),
	$model->OBJETO_ID,
);

$this->menu=array(
	array('label'=>'List Objeto','url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Create Objeto','url'=>array('create'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Update Objeto','url'=>array('update','id'=>$model->OBJETO_ID),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Delete Objeto','url'=>'#','linkOptions'=>array('class'=>'button','submit'=>array('delete','id'=>$model->OBJETO_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Objeto','url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'OBJETO_ID',
		'DATA_CRIACAO',
		'ESTADO',
		'COMENTS',
		'TIPO',
	),
)); ?>
