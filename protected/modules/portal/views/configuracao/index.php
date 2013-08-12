<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-wrench icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink'=>false,
        'links'=>array(t('Dashboard')=>$this->createUrl('/portal/'),
                       t('Sensores')=>$this->createUrl('/portal/sensores/index'), 
                       $this->pageTitle),
    )); ?>
    
    
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'×', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true,), // success, info, warning, error or danger
        ),
    )); ?> 
    
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'horizontalForm',
            'type'=>'horizontal',
    )); ?>
    
    
        <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Passos de Configuração'),
            'headerIcon' => 'icon-wrench',
            )); ?>
    
        
            <?php
                        
            if($this->action->id=="index")
            {
                $passo1=$this->renderPartial('passos/passo1',array('form'=>$form,'model'=>$model),true);
                $passo2=$this->renderPartial('passos/passo2',array('form'=>$form,'model'=>$model,'equipamento'=> $equipamento),true);
                $passo3=$this->renderPartial('passos/passo3',array('form'=>$form,'model'=>$model,'sensor'=>$sensor),true);
                $passo4=$this->renderPartial('passos/passo4',array('form'=>$form,'model'=>$model,'sensor'=>$sensor),true);
                $passo5="";
                
                $active_first=true;
                $active_last=false;
            }else if($this->action->id=="teste")
            {
                $passo1="";
                $passo2="";
                $passo3="";
                $passo4="";
                $passo5=$this->renderPartial('passos/passo5',array('form'=>$form,'sensor'=>$sensor),true);
                
                $active_first=false;
                $active_last=true;
            }
            ?>
    
            <?php $this->widget('bootstrap.widgets.TbWizard', array(
                    'id'=>'rootwizard',
                    'type' => 'tabs', // 'tabs' or 'pills'
                    'pagerContent' => '
                            <div style="float:right">
                                    <input type="button" class="btn button-next" name="next" value="Seguinte" />
                            </div>
                            <div style="float:left">
                                    <input type="button" class="btn button-previous" name="previous" value="Anterior" />
                            </div><br /><br />',
                    'options' => array(
                            'nextSelector' => '.button-next',
                            'previousSelector' => '.button-previous',
                            'firstSelector' => '.button-first',
                            'lastSelector' => '.button-last',	
                            'onTabShow' => 'js:function(tab, navigation, index) {
                                    var $total = navigation.find("li").length;
                                    var $current = index+1;
                                    var $percent = ($current/$total) * 100;
                                    $("#wizard-bar > .bar").css({width:$percent+"%"});
                            }',
                            'onTabClick' => 'js:function(tab, navigation, index) {
                                    return false;
                            }',
                            'onNext'=>'js:function(tab, navigation, index) {
                                    return validaForm(index);
                            }',
                    ),
                    'tabs' => array(
                            array('label' => t('Localização do Sensor'), 'content' => $passo1, 'active' => $active_first),
                            array('label' => t('Equipamento'), 'content' => $passo2),
                            array('label' => t('Alertas'), 'content' => $passo3),
                            array('label' => t('Dados do Sensor'), 'content' => $passo4),
                            array('label' => t('Testar Sensor'), 'content' => $passo5, 'active' => $active_last),
                    ),
            )); ?>
            
            <?php $this->widget('bootstrap.widgets.TbProgress', array(
                'percent'=>40, // the progress
                'striped'=>true,
                'animated'=>true,
                'htmlOptions'=>array('id'=>'wizard-bar')
            ));?>
        
        <?php $this->endWidget();?>
    
    <?php $this->endWidget();?>
    
</div><!--/span-->
<script language="javascript">
    
    // GERAL
    // --------------------------------------------------------------------------
      
      
    <?php if($this->action->id=="teste"): ?>
        $('.button-next').hide();
    <?php endif; ?>
    
    var tab=1;
    
    $('.button-next').attr('disabled','disabled');
    verificaTab();
 
    $('.button-next').click(function(){
        tab++;
        if(!validaForm(tab))
            $('.button-next').attr('disabled','disabled');
        
        verificaTab();
    });
    
    $('.button-previous').click(function(){
        tab--;
        $('.button-next').removeAttr('disabled');
        verificaTab();
    });
    
    function verificaTab()
    {
        $('.button-previous').show();
        
        if(tab==1){
            $('.button-previous').hide();
       } else if(tab==4)
            $('.button-next').val('Gravar Sensor');
        else if(tab==5)
            gravaSensor();
        else
            $('.button-next').val('Seguinte');
    }
    
    function validaForm(i)
    {
        var validate=true;
        
        if(i==1)
        {
            $("#entidades, #instituicoes, #compartimentos ").each(function() {
                if($(this).val() === "" || $(this).val() === null)
                    validate=false;
             });
             
        }else if(i==2){
            
            if(!$('input[type=checkbox]').is(':checked'))
            {
                if($("#equipamentos").val() === "" || $("#equipamentos").val() === null)
                    validate=false;
            }
            
        }else if(i==3){
            
            
        }else if(i==4){
            $("#txt_identificacao, #txt_vmax, #txt_vmin, #unidades").each(function() {
                if($(this).val() === "" || $(this).val() === null)
                    validate=false;
             });
        }
        
        return validate;
    }
    
    function next(num)
    {
        if(validaForm(num))
            $('.button-next').removeAttr('disabled');
        else
            $('.button-next').attr('disabled','disabled');
    }
    
    function gravaSensor()
    {
        var url="<?php echo CController::createUrl('/portal/configuracao/gravasensor'); ?>";
        $.ajax({
            type: "POST",
            data: $('form').serialize(),
            url: url,
            dataType: "json",
            success: function(result){
                
                if(result.sucess){
                    window.location = "<?php echo CController::createUrl('/portal/configuracao/teste/id'); ?>/"+result.id;
                }
                else
                     alert('Erro no Pedido Ajax. "'+url+'"');
                 
                
            }
        });
        
    }
        
    
    // SCRIPTS PASSO 1 
    // --------------------------------------------------------------------------
    
    $("#entidades, #instituicoes, #compartimentos ").change(function(){
        next(1);
    });
    
    $('#entidades').change(function(){
        actualizaInstituicoes($(this).val());
        
        if($('.compartimentos').css('display')!='none')
        {
            $('.compartimentos').hide();
            $('#compartimentos').html('');
        }
        
    });
    
    $('#instituicoes').change(function(){
        actualizaCompartimentos($(this).val());
    });
    
    $('#compartimentos').change(function(){
        actualizaEquipamentos($(this).val());
    });
    
    function actualizaInstituicoes(id_ent)
    {
        $.ajax({
            type: "POST",
            data: "ID_ENT="+id_ent,
            url: "<?php echo CController::createUrl('/portal/configuracao/dynamicinstituicoes'); ?>",
            dataType: "html",
            success: function(result){
                
                 $('#instituicoes').html(result);
                 $('.instituicoes').show();
            }
        });
    }
    
    function actualizaCompartimentos(id_inst)
    {
        $.ajax({
            type: "POST",
            data: "ID_INST="+id_inst,
            url: "<?php echo CController::createUrl('/portal/configuracao/dynamiccompartimentos'); ?>",
            dataType: "html",
            success: function(result){
                
                 $('#compartimentos').html(result);
                 $('.compartimentos').show();
            }
        });
    }
    
    function actualizaEquipamentos(id_comp,id_sel)
    {
        $.ajax({
            type: "POST",
            data: "ID_COMP="+id_comp,
            url: "<?php echo CController::createUrl('/portal/configuracao/dynamicequipamentos'); ?>",
            dataType: "html",
            success: function(result){
                
                 $('#equipamentos').html(result);
                 
                 if(id_sel){
                     $('#equipamentos option[value='+id_sel+']').attr('selected', 'selected');
                     hideNovoEquipamento();
                 }
            }
        });
    }
    
    
    // SCRIPTS PASSO 2 
    // --------------------------------------------------------------------------
    
    
    $('input[type=checkbox]').change(function(){
        validaForm(2);
        if($(this).is(':checked'))
        {
            $('#equipamentos').attr('disabled','disabled');
            $('#novo-equipamento').attr('disabled','disabled');
            $('.novo-equipamento').hide();
            $('#novo-equipamento').show();
        }
        else{
            $('#equipamentos').removeAttr('disabled');
            $('#novo-equipamento').removeAttr('disabled');
        }
    });
    
    $("#equipamentos, input[type=checkbox]").change(function(){
        next(2);
    });


    $('#novo-equipamento').click(function(){
        $('.button-next').attr('disabled','disabled');
        
        $('#equipamentos').attr('disabled','disabled');
        $('.novo-equipamento').show();
        
        $(this).hide();
    });
    
    $('#cancel-equipamento').click(function(){
        hideNovoEquipamento();
    });
    
    $('#save-equipamento').click(function(){
        gravaEquipamento();
    });
    
    function hideNovoEquipamento()
    {
        $('#txt_equipamento').val('');
        $('.novo-equipamento').hide();
        $('#novo-equipamento').show();
        $('#equipamentos').removeAttr('disabled');
        
        next(2);
    }
    
    function gravaEquipamento()
    {
        var url= "<?php echo CController::createUrl('/portal/configuracao/gravaequipamento'); ?>";
        $.ajax({
            type: "POST",
            data: "IDENTIFICACAO="+$('#txt_equipamento').val()+"&ID_COMP="+$('#compartimentos').val(),
            url: url,
            dataType: "json",
            success: function(result){
                
                 if(result.sucess)
                    actualizaEquipamentos($('#compartimentos').val(),result.id);
                 else
                     alert('Erro no Pedido Ajax. "'+url+'"');
            }
        });
        
        
    }
    
    // SCRIPTS PASSO 3 
    // --------------------------------------------------------------------------
    
    
    // SCRIPTS PASSO 4 
    // --------------------------------------------------------------------------
    
    
    $("#txt_identificacao, #txt_vmax, #txt_vmin, #unidades").change(function(){
        
        if(validaForm(4))
            $('.button-next').removeAttr('disabled');
        else
            $('.button-next').attr('disabled','disabled');
    });
    
    
    
</script>       
