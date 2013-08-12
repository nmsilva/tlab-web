<?php

$this->menu=array(
	array('label'=>'List Galeria','url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Create Galeria','url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model,
                                               'xmodel'=>$xmodel,
                                               'imagens'=>$imagens)); ?>