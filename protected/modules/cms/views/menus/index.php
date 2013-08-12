<?php

$this->menu=array(
	array('label'=>t('Adicionar Menu'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'object-grid',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
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
            array('name'=>'ID_MENU',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'10%'),
                    'value'=>'$data->ID_MENU',
                ),
            array('name'=>'NOME',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'80%'),
                    'value'=>'$data->NOME',
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