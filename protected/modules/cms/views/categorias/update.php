<?php
$this->menu=array(
	array('label'=>t('Listar Categorias'),'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Adicionar Categoria'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model,
			'categoria_idioma'=>$categoria_idioma,)); ?>