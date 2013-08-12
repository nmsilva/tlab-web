<div style="min-height: 200px;">
    <fieldset>
        <?php echo $form->dropDownListRow($sensor,'ID_USER', 
                   CHtml::listData(array_merge(array(array('NOME'=>t('- Escolha Técnico -'))),
                        Utilizador::model()->findAll('ID_TIPO=2')),'ID_USER','NOME'),
                   array('id'=>'tecnico')); ?>
        
        <?php echo $form->textFieldRow($sensor, 'EMAIL_AVISO',array('id'=>'txt_aviso','hint'=>t('Contacto para aviso no caso do sensor exceder valores permitidos'))); ?>
        
    </fieldset>
</div>
