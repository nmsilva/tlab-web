<?php
$this->menu=array(
	array('label'=>t('Adicionar Artigo'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'object-grid',
    'dataProvider'=>$dataProvider,
    'summaryText'=>t('Mostra').' {start} - {end} '.t('em'). ' {count} '.t('resultados'),
    'filter' => $model,
    'pager' => array(
            'header'=>t('Ir par a Página:'),
            'nextPageLabel' => t('Seguinte'),
            'prevPageLabel' => t('Anterior'),
            'firstPageLabel' => t('Primeiro'),
            'lastPageLabel' => t('Ultimo'),
            'pageSize'=> 10
	),
	'columns'=>array(
		array('name'=>'OBJETO_ID',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'6%'),
			'value'=>'$data->OBJETO_ID',
		    ),
		array(
			'name'=>'TITULO',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'45%'),
			'value'=>'(isset($data->TITULO)) ? $data->TITULO : t("Não Definido")',
		    ),
		array(
			'name'=>'ID_CAT',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'25%'),
			'value'=>'Categoria::model()->getTitleCategoria($data->ID_CAT)',
                        'filter'=>CHtml::listData(Categoria::model()->findAll(),'ID_CAT','SLUG'),
		    ),
                array(
			'name'=>'ESTADO',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'15%'),
			'filter'=>array(Helper::ACTIVE_DATA => Helper::ACTIVE_DATA_STRING,Helper::DESACTIVE_DATA => Helper::DESACTIVE_DATA_STRING),
			'value'=>'Helper::getEstadoData($data->ESTADO)',
		    ),            		
		array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{update} {delete}',
                        'buttons' => array(
                            'update' => array(
                                'label'=> t('Editar'),
                                'options'=>array(
                                    'class'=>'btn btn-small update'
                                )
                            ),
                            'delete' => array(
                                'label'=> t('Apagar'),
                                'options'=>array(
                                    'class'=>'btn btn-small delete'
                                )
                            )
                        ),
                        'deleteConfirmation'=>t('Tem a Certeza que deseja eliminar este Item?'),
		),
	),
)); ?>
