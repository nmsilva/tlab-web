<?php

$this->menu=array(
	array('label'=>t('Ver Idiomas'),'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Adicionar Idioma'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Apagar Idioma'),'url'=>'#','linkOptions'=>array('class'=>'button','submit'=>array('delete','id'=>$model->LANG_ID),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>