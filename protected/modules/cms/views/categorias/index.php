<?php

$this->menu=array(
	array('label'=>t('Adicionar Categoria'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
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
            array('name'=>'ID_CAT',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'10%'),
                    'value'=>'CHtml::link($data->ID_CAT,array("'.app()->controller->id.'/view","id"=>$data->ID_CAT))',
                ),
            array(
                    'name'=>'TITULO',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'36%'),
                    'value'=>'(isset($data->TITULO)) ? $data->TITULO : t("Não Definido")',
                    //'value'=>'print_r($data)',
                ),
            array(
                    'name'=>'SLUG',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'26%'),
                    'value'=>'$data->SLUG',
                ),               
            array(
                    'name'=>'ESTADO',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'19%'),
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


