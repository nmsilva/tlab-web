<?php
$this->breadcrumbs=array(
	'Menus'=>array('index'),
	$model->ID_MENU,
);

$this->menu=array(
	array('label'=>'List Menu','url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Create Menu','url'=>array('create'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Update Menu','url'=>array('update','id'=>$model->ID_MENU),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Delete Menu','url'=>'#','linkOptions'=>array('class'=>'button','submit'=>array('delete','id'=>$model->ID_MENU),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Menu','url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID_MENU',
		'NOME',
		'DATA_CRIACAO',
	),
)); ?>
