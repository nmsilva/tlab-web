
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'item-form',
    'enableAjaxValidation'=>FALSE,
)); ?>

    <div class="modal-body">
        
        <div id="errors" style="display: none;" class="alert in alert-block fade alert-error">
            <strong>Erros!</strong>
            <label></label>
        </div>
        
        <?php echo $form->hiddenField($item_menu,'ID_MENU',array('value'=>$model->ID_MENU)); ?>
        
        <?php echo $form->hiddenField($item_menu,'ID_MENU_ITEM',array('value'=>$item_menu->ID_MENU_ITEM)); ?>
        
        <?php 
        $sql='SELECT t.ID_MENU_ITEM, (SELECT nome FROM item_menu_idioma WHERE ID_MENU_ITEM=t.ID_MENU_ITEM and LANG_ID='
             .Idioma::model()->getDefaultLang().') as NOME '
             .'FROM menu_item as t '
             .'WHERE t.ID_MENU='.$model->ID_MENU;

        echo $form->dropDownListRow($item_menu,'MEN_ID_MENU_ITEM', 
                    CHtml::listData(MenuItem::model()->findAllBySql($sql),'ID_MENU_ITEM','NOME'),
                    array('empty' => t('(sem item)'))); ?>
        
        <?php echo $form->dropDownListRow($item_menu,'TIPO', Helper::getTiposMenuItem(),array('id'=>'cmb_tipos')); ?>

        <div id="categoria">
            <?php echo $form->dropDownListRow($item_menu,'ID_CAT', 
                                CHtml::listData(Categoria::model()->findAll(),'ID_CAT','SLUG')); ?>
        </div>
        
        <div id="value" style="display: none;">
            <?php echo $form->textFieldRow($item_menu,'VALOR',array('style'=>'width:95%;','maxlength'=>255)); ?>
        </div>

    </div>

        <?php echo CHtml::button(t('Gravar'),array('class'=>'bebutton','id'=>'closeJobDialog')); ?>
        
        <?php echo CHtml::button(t('Cancelar'),array('class'=>'bebutton','id'=>'cancel')); ?>
        


    <script>
        $(document).ready(function(){
            $('#closeJobDialog').click(function(){
                $.ajax({
                    url: "<?php echo CHtml::normalizeUrl(array('/cms/menus/addItem')); ?>",
                    context: document.body,
                    type: "POST",
                    data: $('#item-form').serialize(),
                    dataType: "json"
                  }).done(function(data) { 
                            //alert(data);
                            if(data.sucess){
                                location.reload();
                            }else{
                                $("#errors").show();
                                $("#errors label").html("<?php echo t('Insira todos os Valores'); ?>");
                           }
                  });
                return false;
            });
            
            $('#cancel').click(function(){
                $('#jobDialog').dialog('close');
            });
            
            $("#categoria").hide();
            $("#value").hide();
            if($('#cmb_tipos').val()==0){
                $("#categoria").show();
            }
            else if($('#cmb_tipos').val()==1){
                $("#value").show();
            }
                
            $('#cmb_tipos').change(function (){
                $("#categoria").hide();
                $("#value").hide();
                if($(this).val()==0){
                    $("#categoria").show();
                }
                else if($(this).val()==1){
                    $("#value").show();
                }
            });
            
        });
    </script>
<?php $this->endWidget(); ?>

