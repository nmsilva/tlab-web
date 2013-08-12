<?php

$this->menu=array(
	array('label'=>'Create Media','url'=>array('create'),'linkOptions'=>array('class'=>'button')),
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
            array('name'=>'ID_MEDIA',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'7%'),
                    'value'=>'$data->ID_MEDIA',
                ),
            array(
                    'name'=>'PATH',
                    'type'=>'html',
                    'htmlOptions'=>array('width'=>'10%'),
                    'value'=>'(!empty($data->PATH))?CHtml::image(Media::model()->getPublicUrl()."/".$data->PATH,"",array("style"=>"width:75px;height:45px;")):"no image"',
            ),
            array(
                    'name'=>'NOME',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'28%'),
                    'value'=>'$data->NOME',
                ),
            array(
                    'name'=>'TYPE',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'26%'),
                    'value'=>'Helper::getTiposMedia($data->TYPE)',
                ), 
            array(
                    'name'=>'DATA_CRIACAO',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'20%'),
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

