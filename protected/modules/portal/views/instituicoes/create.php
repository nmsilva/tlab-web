<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-user icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink'=>false,
        'links'=>array(t('Dashboard')=>$this->createUrl('/portal/'),
                       t('Entidades')=>$this->createUrl('/portal/entidades/index'),
                       $model->ENTIDADE->NOME=>$this->createUrl('/portal/entidades/update/id/'.$model->ID_ENT), 
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
    
    <?php 
    $headerButtons=array(
            array('class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons'=>array(
                            array('label'=>'Voltar', 'url'=> $this->createUrl('/portal/entidades/update/id/'.$model->ID_ENT))
                    ),
            ),
        );
    
    ?>
    
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'horizontalForm',
		'type'=>'horizontal',
	)); ?>
    
        <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Informação'),
            'headerIcon' => 'icon-list-alt',
            'headerButtons' => $headerButtons,
        )); ?>
        
        
    
            <fieldset>
                
                <?php echo $form->textFieldRow($model, 'IDENTIFICACAO',array('class'=>'span8')); ?>
                
                <?php echo $form->hiddenField($model, 'ID_ENT'); ?>
                
            </fieldset>
            
    
        <?php $this->endWidget(); ?>
        
        <?php if(!$model->isNewRecord): ?>
    
            <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title' => t('Compartimentos'),
                'headerIcon' => 'icon-list-alt',
                'headerButtons' => array(
                    array('class' => 'bootstrap.widgets.TbButtonGroup',
                                'buttons'=>array(
                                        array('label'=>t('Novo Compartimento'), 
                                              'url'=> '',
                                              'htmlOptions'=>array('onclick'=>'novoCompartimento(-1);')))
                                ),
                        ),
            )); ?>

                    <div id="novo-compartimento" style="display: none;">
                        <input type="text" name="Compartimento[IDENTIFICACAO]" class="span5 novo_comp">
                        <input type="hidden" name="Compartimento[ID_INST]" value="<?php echo $model->ID_INST; ?>">
                        <input type="hidden" name="Compartimento[ID_COMP]" class="id_comp">
                        <button type="button" class="btn" onclick="gravaCompartimento();">Gravar</button>
                        <button type="button" class="btn" onclick="cancelar();">Cancelar</button>
                    </div>
                    <script language="javascript">
    
                        function cancelar()
                        {
                            $('#novo-compartimento').hide('swing');
                        }
                        
                        function novoCompartimento(id_comp)
                        {
                            $('.id_comp').val(id_comp);
                            
                            if(id_comp!=-1){
                                getNomeCompartimento(id_comp);
                            }else{
                                $('.novo_comp').val('');
                                $('#novo-compartimento').show('swing');
                            }
                            
                        }
                        
                        function gravaCompartimento()
                        {

                            $.ajax({
                                type: "POST",
                                data: $('form').serialize(),
                                url: "<?php echo CController::createUrl('/portal/instituicoes/gravacompartimento'); ?>",
                                dataType: "html",
                                success: function(result){

                                     $('#novo-compartimento').hide('swing');

                                     $.fn.yiiGridView.update('compartimentos-grid');

                                }
                            });
                        }
                        
                        function getNomeCompartimento(id_comp){
                            $.ajax({
                                type: "POST",
                                data: "ID_COMP="+id_comp,
                                url: "<?php echo CController::createUrl('/portal/instituicoes/nomecompartimento'); ?>",
                                dataType: "html",
                                success: function(result){
                                    
                                    $('.novo_comp').val(result);
                                    $('#novo-compartimento').show('swing');
                                    
                                }
                            });
                        }

                    </script>

                    <?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
                            'id'=>'compartimentos-grid',
                            'dataProvider' => $dataProvider,
                            'responsiveTable' => true,
                            'template' => "{items}",
                            'columns' => array(
                                    array('name'=>'ID_COMP',
                                      'type'=>'raw',
                                      'value'=>'$data->ID_COMP',
                                    ),
                                    array('name'=>'IDENTIFICACAO',
                                      'type'=>'raw',
                                      'value'=>'$data->IDENTIFICACAO',
                                    ),
                                    array(
                                        'class'=>'bootstrap.widgets.TbButtonColumn',
                                        'htmlOptions' => array('nowrap'=>'nowrap'),
                                        'template' => '{update} {delete}',
                                        'buttons' => array(
                                            'delete' => array(
                                                'options'=>array(
                                                    'class'=>'btn btn-small delete',
                                                ),
                                                'url'=>'CController::createUrl("/portal/instituicoes/deletecompartimento", array("id"=>$data->primaryKey))'
                                            ),
                                            'update' => array(
                                                'options'=>array(
                                                    'class'=>'btn btn-small update',
                                                    'onclick'=>'novoCompartimento($(this).attr("href")); return false;'
                                                )
                                            )
                                        ),
                                        'deleteConfirmation'=>t('Tem a Certeza que deseja eliminar este Item?'),
                                    ),
                            ),
                    ));?>

            <?php $this->endWidget();?>

        <?php endif; ?>

        <div class="form-actions" style="padding-left: 0;">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>t('Gravar'))); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>t('Cancelar'))); ?>
        </div>
    
    <?php $this->endWidget();?>
</div>

