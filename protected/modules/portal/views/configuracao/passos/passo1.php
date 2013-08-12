<div style="min-height: 200px;">
    <fieldset>

        <?php echo $form->dropDownListRow($model,'ID_ENT', 
                   CHtml::listData(array_merge(array(array('NOME'=>t('- Escolha Entidade -'))),
                                                Entidade::model()->findAll()),'ID_ENT','NOME'),
                   array('id'=>'entidades')); ?>

        <div class="instituicoes" style="display: none;">
            
            <?php echo $form->dropDownListRow($model,'ID_INST', array(),
                   array('id'=>'instituicoes')); ?>

        </div>
        
        <div class="compartimentos" style="display: none;">
             <?php echo $form->dropDownListRow($model, 'ID_COMP',array(),
                     array('multiple'=>true,'id'=>'compartimentos')); ?>
        </div>
        
    </fieldset>
</div>