<?php
$this->menu=array(
	array('label'=>t('Adicionar Idioma'),'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
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
            array('name'=>'LANG_ID',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'7%'),
                    'value'=>'CHtml::link($data->LANG_ID,array("'.app()->controller->id.'/view","id"=>$data->LANG_ID))',
                ),
            array('name'=>'BANDEIRA',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'3%'),
                    'value'=>'CHtml::image(Yii::app()->getAssetManager()->publish(Yii::app()->getModule("site")->getBasePath()."/assets/images/bandeiras/".$data->BANDEIRA),"image",array("width"=>"30px"))',
                ),
            array(
                    'name'=>'DESCRI',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'50%'),
                    'value'=>'$data->DESCRI',
                ),            
            array(
                    'name'=>'ESTADO',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'13%'),
                    'filter'=>array(Helper::ACTIVE_DATA => Helper::ACTIVE_DATA_STRING,Helper::DESACTIVE_DATA => Helper::DESACTIVE_DATA_STRING),
                    'value'=>'Helper::getEstadoData($data->ESTADO)',
                ),             
            array(
                    'name'=>'SHORT',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'15%'),
                    'value'=>'$data->SHORT',
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
