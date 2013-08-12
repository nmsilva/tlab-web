<?php

$this->menu=array(
	array('label'=>'List Categorias','url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Create Categorias','url'=>array('create'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Update Categorias','url'=>array('update','id'=>$model->ID_CAT),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Delete Categorias','url'=>'#','linkOptions'=>array('class'=>'button','submit'=>array('delete','id'=>$model->ID_CAT),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Categorias','url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID_CAT',
		'SLUG',
		'ESTADO',
	),
)); ?>
