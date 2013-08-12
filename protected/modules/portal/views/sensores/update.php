<div class="span3">
    
    <?php $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-home icon-white"></i>
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
    
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Sensor'),
            'headerIcon' => 'icon-list-alt',
            'headerButtons' => array(
                array(
                        'class' => 'bootstrap.widgets.TbButtonGroup',
                                'toggle' => 'radio',
                                'buttons'=>array(
                                        array('label' => t('Opções'), 'url' => '#'), 
                                        array('items' => array(
                                                array('label'=>t('Voltar'), 'url'=>$this->createUrl('/portal/sensores/index/type/sensor/id/'.$model->ID_SENSOR)),
                                                array('label'=>t('Apagar'), 
                                                      'url' => '#',
                                                      'linkOptions'=>array('onclick'=>'js:bootbox.confirm("Confirma a eliminação deste item?",
                                                                         function(confirmed){ if(confirmed) window.location = "'.$this->createUrl('/portal/sensores/delete/id/'.$model->ID_SENSOR.'/confirm').'"; })')),
                                                '---',
                                                array('label' => t('Consultar Erros'), 'url' => $this->createUrl('/portal/sensores/erros/type/sensor/id/'.$model->ID_SENSOR)),
                                                array('label' => t('Gerar Relatório'), 'url' => $this->createUrl('/portal/relatorios/index/type/sensor/id/'.$model->ID_SENSOR)),
                                        ))
                                ),
                        ),
            )
        )); ?>
    
                  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'horizontalForm',
                    'type'=>'horizontal',
                  )); ?>
    
                        <fieldset>
                            
                            <?php echo $form->textFieldRow($model->COMPARTIMENTO->INSTITUICAO->ENTIDADE, 'NOME',array('disabled'=>true)); ?>
                            
                            <div class="control-group ">
                                <label class="control-label">Instituição</label>
                                <div class="controls">
                                    <?php echo CHtml::dropDownList('instituicoes', $model->COMPARTIMENTO->INSTITUICAO->ID_INST, 
                                    CHtml::listData($model->COMPARTIMENTO->INSTITUICAO->ENTIDADE->INSTITUICOES,'ID_INST','IDENTIFICACAO'),
                                     array('id'=>'instituicoes')); ?>
                                </div>
                            </div> 
                            
                            <?php echo $form->dropDownListRow($model, 'ID_COMP',CHtml::listData($model->COMPARTIMENTO->INSTITUICAO->COMPARTIMENTOS,'ID_COMP','IDENTIFICACAO'),
                            array('multiple'=>true,'id'=>'compartimentos')); ?>
                            
                            <?php echo $form->textFieldRow($model, 'IDENTIFICACAO',array('id'=>'txt_identificacao')); ?>
                            
                            <?php echo $form->dropDownListRow($model,'ID_UNI', 
                            CHtml::listData(array_merge(array(array('IDENTIFICACAO'=>t('- Escolha Unidade -'))),
                                                         Unidade::model()->findAll()),'ID_UNI','IDENTIFICACAO'),
                            array('id'=>'unidades')); ?>
                            
                            <?php echo $form->textFieldRow($model, 'VMAX',array('id'=>'txt_vmax')); ?>

                            <?php echo $form->textFieldRow($model, 'VMIN',array('id'=>'txt_vmin')); ?>
                        
                            
                            <?php echo $form->dropDownListRow($model,'ID_USER', 
                                        CHtml::listData(array_merge(array(array('NOME'=>t('- Escolha Técnico -'))),
                                             Utilizador::model()->findAll('ID_TIPO=2')),'ID_USER','NOME'),
                                        array('id'=>'tecnico')); ?>

                            <?php echo $form->textFieldRow($model, 'EMAIL_AVISO',array('id'=>'txt_aviso','hint'=>t('Contacto para aviso no caso do sensor exceder valores permitidos'))); ?>

                            <div class="form-actions">
                               <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>t('Gravar'))); ?>
                               <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>t('Cancelar'))); ?>
                            </div>
                            
                        </fieldset>
    
                  <?php $this->endWidget(); ?>
    
        <?php $this->endWidget(); ?>
    
</div><!--/span-->

<script language="javascript">

var comp_sel=<?php echo $model->COMPARTIMENTO->ID_COMP; ?>

$('#instituicoes').change(function(){
    actualizaCompartimentos($(this).val());
});

function actualizaCompartimentos(id_inst)
{
    $.ajax({
        type: "POST",
        data: "ID_INST="+id_inst,
        url: "<?php echo CController::createUrl('/portal/configuracao/dynamiccompartimentos'); ?>",
        dataType: "html",
        success: function(result){

             $('#compartimentos').html(result);
             
             $('#compartimentos option[value='+comp_sel+']').attr('selected', 'selected');
        }
    });
}
    
</script>
