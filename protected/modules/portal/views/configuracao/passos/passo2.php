<div style="min-height: 200px;">
    <fieldset>
        
        <?php echo $form->checkBoxListInlineRow($model, 'CHECK_EQUIP',
                array(t('Este Sensor não está associado a nenhum Equipamento'))); ?>
        
        <div class="control-group ">
            <label class="control-label"><?php echo t("Equipamento");?></label>
            <div class="controls">
                <?php echo $form->dropDownList($model,'ID_EQUIP', array(),
                   array('id'=>'equipamentos')); ?>
                <button type="button" id="novo-equipamento" class="btn show-tooltip" data-toggle="tooltip" title="<?php echo t("Adicionar Equipamento"); ?>"><i class="icon-plus"></i></button>
            </div>
        </div>
        
        <div class="novo-equipamento" style="display: none;">
            <div class="control-group ">
                <label class="control-label"><?php echo t("Identificação");?></label>
                <div class="controls">
                    <?php echo $form->textField($equipamento,'IDENTIFICACAO',array('id'=>'txt_equipamento')); ?>
                    <button type="button" id="save-equipamento" class="btn show-tooltip" data-toggle="tooltip" title="<?php echo t("Guardar"); ?>"><i class="icon-ok"></i></button>
                    <button type="button" id="cancel-equipamento" class="btn show-tooltip" data-toggle="tooltip" title="<?php echo t("Cancelar"); ?>"><i class="icon-remove"></i></button>
                </div>
            </div>
            
        </div>
        
    </fieldset> 
   
</div>