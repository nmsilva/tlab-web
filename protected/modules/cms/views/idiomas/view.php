<?php

$this->menu=array(
	array('label'=>t('Ver Idiomas'),'url'=>array('index'),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Adicionar Idioma'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Editar Idioma'),'url'=>array('update','id'=>$model->LANG_ID),'linkOptions'=>array('class'=>'button')),
	array('label'=>t('Apagar Idioma'),'url'=>'#','linkOptions'=>array('class'=>'button','submit'=>array('delete','id'=>$model->LANG_ID),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'LANG_ID',
		'NOME',
		'DESCRI',
		array(              
            'label'=>'Estado',
            'type'=>'raw',
            'value'=> t(Helper::getEstadoData($model->ESTADO)),
        ),
		'SHORT',
		array(              
            'label'=>'Obrigatório',
            'type'=>'raw',
            'value'=> t(Helper::getObrigatorioString($model->REQUIRED)),
        ),
	),
)); ?>
