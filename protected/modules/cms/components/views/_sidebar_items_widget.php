<div class="taxonomy_lang_<?php echo $this->term['lang']; ?> taxonomy_lang_wrap" id="taxonomy_<?php echo $this->term['id']; ?>_<?php echo $this->term['lang']; ?>">
<div class="content-box">
        <div class="content-box-header">
        <h3><?php echo t($this->term['title']); ?></h3>
        </div> 
        <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                  
                    <div class="list_terms">
                        <div class="list_terms_inner" id="list_terms_<?php echo $this->term['id']; ?>" >
                             <?php 
                             
                                            //Prepare terms name for this CAutoComplete
                                            $terms_name=array();
                                            foreach($this->term['terms'] as $t){
                                                $terms_name[]=$t['name'];
                                            }
                                            $this->widget('CAutoComplete', array(  
                                                    'name'=>'Categorias',
                                                    'data'=>$terms_name,                                                    
                                                    'multiple'=>true,
                                                    'mustMatch'=>true,
                                                    'htmlOptions'=>array('size'=>50,'class'=>'maxWidthInput','id'=>'term_auto_'.$this->term['id']),
                                                    'methodChain'=>".result(function(event,item){    
                                                        
                                                        if(item!==undefined) {
                                                            if(\$('#list_terms_".$this->term['id']."').has('span[rel='+item+']')){

                                                                 var object=\$('#list_terms_".$this->term['id']."').children('span[rel='+item+']').clone();
                                                                 \$(object).children('input').prop('checked', true);
                                                                 \$(object).appendTo(\$('#selected_terms_".$this->term['id']."'));
                                                                 \$('#list_terms_".$this->term['id']."').children('span[rel='+item+']').remove();

                                                            }

                                                            \$('#term_auto_".$this->term['id']."').val('');
                                                        }
                                                        

                                                    })",
                                            )); ?>
                        </div>
                    </div>
                    <div class="selected_terms">
                        <div class="selected_terms_inner" id="selected_terms_<?php echo $this->term['id']; ?>" ></div>
                    </div>
                   
                </div>       

        </div>
</div>

<script type="text/javascript">      
     <?php  
     
     //List of Terms of current Taxonomy
     echo 'var array_term_'.$this->term['id'].'='.json_encode($this->term['terms']).';'; 
          
     ?>
    //List of selected Terms         
     <?php if ((!empty($this->selected_terms))&&(isset($this->selected_terms[$this->key]))) : ?>
         <?php echo 'var array_selected_term_'.$this->term['id'].'='.json_encode($this->selected_terms[$this->key]['terms']).';'; 

         ?>
         //Create checkbox for selected terms  
         $.each(array_selected_term_<?php echo $this->term['id']; ?>, function(k,v) {   
                if(!$("#selected_terms_<?php echo $this->term['id']; ?>").children().children('#'+k).length>0){
                    var object_input=$('#selected_terms_<?php echo $this->term['id']; ?>').append('<span rel="'+v.name+'"><input value="'+v.id+'" id="'+k+'" onChange="checkATerm<?php echo $this->term['id'];?>(\''+k+'\',this);" type="checkbox" name="terms[]" /> '+v.name+'<br/></span>');

                    $(object_input).children().children('input').prop("checked", true);

                }

         }); 
        
     <?php endif; ?>
       
     
     
     //Create checkbox for unchecked terms
     $.each(array_term_<?php echo $this->term['id']; ?>, function(k,v) {   
           if(!$("#selected_terms_<?php echo $this->term['id']; ?>").children().children('#'+k).length>0){
                $('#list_terms_<?php echo $this->term['id']; ?>').append('<span rel="'+v.name+'"><input value="'+v.id+'" id="'+k+'" onChange="checkATerm<?php echo $this->term['id'];?>(\''+k+'\',this);" type="checkbox" name="terms[]" /> '+v.name+'<br/></span>');
           }
     });      
     
     function checkATerm<?php echo $this->term['id'];?>(key,object){                   
             if($("#selected_terms_<?php echo $this->term['id']; ?>").children().children('#'+key).length>0){
                 $(object).parent().clone().appendTo($("#list_terms_<?php echo $this->term['id']; ?>"));
                 $(object).parent().empty().remove();
                 
                 if($("#selected_terms_<?php echo $this->term['id']; ?>").html().trim()==''){                     
                     $("#selected_terms_<?php echo $this->term['id']; ?>").html('&nbsp;');
                 }
             } else {                 
             
                 if($("#selected_terms_<?php echo $this->term['id']; ?>").html()=="&nbsp;"){                         
                     $("#selected_terms_<?php echo $this->term['id']; ?>").html("");
                 }
                 
                 $(object).parent().clone().prop("checked", false).appendTo($("#selected_terms_<?php echo $this->term['id']; ?>"));
                 $(object).parent().empty().remove();
             }                     
     }
</script>

</div>
