<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-home icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'×', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true,), // success, info, warning, error or danger
        ),
    )); ?> 
    
    <?php if(isset($_GET['type']) && isset($_GET['id'])): ?>
        
        <script language="javascript">

            function geraDoc(){
                $('form').attr('action','<?php echo $this->createUrl('/portal/relatorios/doc/type/'.$_GET['type'].'/id/'.$model->primaryKey);?>');
            }
            function geraGrafico(){
                $('form').attr('action','');
            }
        </script>

        <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Relatório de ').$model->IDENTIFICACAO,
            'headerIcon' => 'icon-list-alt',
        )); ?>

            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'horizontalForm',
                    'type'=>'horizontal',
            )); ?>
                <fieldset>
                    
                    <?php if($_GET['type']=='equip'):?>
                        <?php echo $form->textFieldRow($model, 'ID_EQUIP', array('disabled'=>true)); ?>
                    <?php elseif($_GET['type']=='sensor'):?>
                        <?php echo $form->textFieldRow($model, 'ID_SENSOR', array('disabled'=>true)); ?>
                    <?php endif; ?>
                    
                    <?php echo $form->textFieldRow($model, 'IDENTIFICACAO', array('disabled'=>true)); ?>
                                        
                    <?php echo $form->datepickerRow($model_form, 'DATA_INICIO',
                    array('prepend'=>'<i class="icon-calendar"></i>')); ?>

                    <?php echo $form->datepickerRow($model_form, 'DATA_FIM',
                    array('prepend'=>'<i class="icon-calendar"></i>')); ?>



                </fieldset>
                <div class="form-actions">
                    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>t('Gerar Gráfico'),'htmlOptions'=> array('onclick'=>'geraGrafico()'))); ?>
                    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>t('Gerar Documento'),'htmlOptions'=> array('onclick'=>'geraDoc()'))); ?>
                </div>
                
            <?php $this->endWidget(); ?>

        <?php $this->endWidget();?>
        
        
            <?php if($model_form->validate() && $_GET['type']=='sensor'): ?>
                
                <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
                    'title' => t('Gráfico'),
                    'headerIcon' => 'icon-list-alt',
                )); ?>

                    <?php // $this->Widget('ext.highstock.HighstockWidget', array(
//                        'options'=>array(
//                          'theme'=>'',
//                          'type'=>'line',
//                          'rangeSelector'=>array('selected'=>1),
//                          'title'=>array('text'=>'USD to EUR exchange rate'),
//                          'xAxis'=>array(
//                              ),
//                          'yAxis'=>array('title'=>array('text'=>'Exchange rate')),
//                          'series'=> $series
//                        ))); ?>
        
                    <?php $this->renderPartial('grafico',array('series'=>$series)); ?>

                <?php $this->endWidget();?>
    
            <?php endif; ?>
    
    <?php endif; ?>
    
</div><!--/span-->
            
