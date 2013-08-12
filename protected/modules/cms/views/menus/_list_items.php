<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'object-grid',
    'dataProvider'=>$dataProvider,
    'rowCssClassExpression'=>'"items[]_{$data->ID_MENU_ITEM}"',
    'template'=>"{items}",
    'summaryText'=>t('Mostra').' {start} - {end} '.t('em'). ' {count} '.t('resultados'),
    'pager' => array(
            'header'=>t('Ir par a Página:'),
            'nextPageLabel' => t('Seguinte'),
            'prevPageLabel' => t('Anterior'),
            'firstPageLabel' => t('Primeiro'),
            'lastPageLabel' => t('Ultimo'),
            'pageSize'=> 10
    ),
    'columns'=>array(
            array(
                'id'=>'autoId',
                'class'=>'CCheckBoxColumn',
                'selectableRows' => '50',   
            ),
            array('name'=>'ID_MENU_ITEM',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'5%'),
                    'value'=>'$data->ID_MENU_ITEM',
                ),
            array('name'=>'MEN_ID_MENU_ITEM',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'15%'),
                    'value'=>'(isset($data->MEN_ID_MENU_ITEM)) ? MenuItem::model()->getNameItem($data->MEN_ID_MENU_ITEM) : t("---")',
                ),
            array('name'=>'TIPO',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'25%'),
                    'value'=>'Helper::getTiposMenuItem($data->TIPO)',
                ),
            array('name'=>'ID_CAT',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'15%'),
                    'value'=>'MenuItem::model()->getNameCategoria($data->ID_MENU_ITEM,$data->ID_CAT)',
                ),
            array('name'=>'NOME',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'20%'),
                    'value'=>'CHtml::textField("NOME[$data->ID_MENU_ITEM]",(isset($data->NOME)) ? $data->NOME : t("Não Definido"),array("style"=>"width:100%;"))',
                ),
            array('name'=>'DESCRICAO',
                    'type'=>'raw',
                    'htmlOptions'=>array('width'=>'30%'),
                    'value'=>'CHtml::textField("DESCRICAO[$data->ID_MENU_ITEM]",(isset($data->DESCRICAO)) ? $data->DESCRICAO : t("Não Definido"),array("style"=>"width:100%;"))',
                ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{update}',
                'header' => 'Action',
                //--------------------- begin new code --------------------------
                'buttons'=>array(
                        'update'=>array(
                                    'label'=>t('Editar'),
                                    'imageUrl'=>true,
                                    'url'=>'$this->grid->controller->createUrl("/cms/menus/createmenuitem",array("id"=>$data->ID_MENU,"item"=>$data->primaryKey))',
                                    'options'=>array(
                                        'onclick'=>' editItem($(this).attr("href")); return false;',
                                    ),
                                  ),
                            ),
                //--------------------- end new code --------------------------
            ),
    ),
)); ?>



        <?php
    $str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#object-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#object-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('/cms/menus/sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";
 
    ?>

<style>
    #object-grid table.items tbody tr:hover{
        cursor: move;
    }
</style>

<script language="javascript">
    
    <?php  echo $str_js; ?>
</script>

