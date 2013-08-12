<?php

$this->menu=array(
	array('label'=>'List Media','url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>'Create Media','url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model,
                                                'terms'=>$terms,
                                                'selected_terms'=>$selected_terms,)); ?>