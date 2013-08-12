<?php if(havePermission(user()->rule)): ?>

    <label>Escolha a Entidade:</label>
    <?php echo CHtml::dropDownList('ID_ENT',(isset($_POST['ID_ENT']))? $_POST['ID_ENT']:0, 
        CHtml::listData(array_merge(array(array('NOME'=>t('- Escolha Entidade -'))),
                        Entidade::model()->findAll()),'ID_ENT','NOME'),
        array('id'=>'entidades','style'=>'width:270px;')); ?>
   
    <script language="javascript">
        $(document).ready(function(){
            if($.cookie("id_ent"))
                carregaItems($.cookie("id_ent"));
            
        });
        
        $('#entidades').change(function(){
            carregaItems($(this).val());
        });
        
        function carregaItems(id_ent)
        {
            var url="<?php echo CController::createUrl('/portal/'.$this->type.'/index'); ?>";
            $.ajax({
                type: "POST",
                data: "ajax=true&ID_ENT="+id_ent,
                url: url,
                dataType: "html",
                success: function(result){
                                        
                    $.cookie("id_ent", id_ent);
                    $('#entidades option[value='+id_ent+']').attr('selected', 'selected');
                    $("#tree-items").html(result);
                    
                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    location.reload();
                }
            });
            
        }

    </script>
    
<?php endif; ?>
    
<div class="well" id="tree-items">

    <?php $this->render('sidebarTreeItems',array('tree_items'=>$tree_items)); ?>
</div>
   
    
    
