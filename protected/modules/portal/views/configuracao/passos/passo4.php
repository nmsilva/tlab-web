<div style="min-height: 200px;">    
    <fieldset>
        
        <?php echo $form->textFieldRow($sensor, 'IDENTIFICACAO',array('id'=>'txt_identificacao')); ?>
        
        <?php echo $form->dropDownListRow($sensor,'ID_UNI', 
                   CHtml::listData(array_merge(array(array('IDENTIFICACAO'=>t('- Escolha Unidade -'))),
                                                Unidade::model()->findAll()),'ID_UNI','IDENTIFICACAO'),
                   array('id'=>'unidades')); ?>
        
        <?php echo $form->textFieldRow($sensor, 'VMAX',array('id'=>'txt_vmax')); ?>
        
        <?php echo $form->textFieldRow($sensor, 'VMIN',array('id'=>'txt_vmin')); ?>
        
    </fieldset>
</div>
