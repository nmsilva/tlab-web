<?php
/* @var $this UsersController */
/* @var $model CMSUser */

$this->menu=array(
	array('label'=>'List CMSUser', 'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Create CMSUser', 'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>