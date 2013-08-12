<?php
$this->menu=array(
	array('label'=>t('Listar Menus'),'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Adicionar Menu'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model,
                                              'item_menu'=>$item_menu)); ?>