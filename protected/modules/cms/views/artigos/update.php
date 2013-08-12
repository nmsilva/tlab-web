<?php

$this->menu=array(
	array('label'=>t('Listar Artigos'),'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Adicionar Artigo'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model,
                            'idioma_artigo'=>$idioma_artigo,
                            'terms'=>$terms,
                            'selected_terms'=>$selected_terms,
                            'imagens'=>$imagens,
                            'imagem'=>$imagem,)); ?>
