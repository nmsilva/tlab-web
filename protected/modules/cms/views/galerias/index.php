<?php
$this->menu=array(
	array('label'=>t('Adicionar Galeria'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
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
            array('name'=>'ID_GALERIA',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'7%'),
                    'value'=>'$data->ID_GALERIA',
                ),
            array(
                    'name'=>'NOME',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'58%'),
                    'value'=>'$data->NOME',
                ),
            array(
                    'name'=>'DATA_CRIACAO',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'26%'),
                    'value'=>'$data->DATA_CRIACAO',
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