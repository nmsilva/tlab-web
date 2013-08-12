<div class="closed-box content-box">
        <div class="content-box-header">
            <h3><?php echo t('Dados Gerais');?></h3>                             
        </div> 
        <div class="content-box-content" style="display: block;">

                <div class="tab-content default-tab" id="extra_box">

                        <?php echo $form->dropDownListRow($model,'ESTADO', Helper::getEstadosArray()); ?>
                        
                        <?php if(!$model->isNewRecord): ?>
                            <?php echo $form->textFieldRow($model,'SLUG',array('style'=>'width:85%;','maxlength'=>255,'id'=>'txt_slug')); ?>
                    
                            <?php echo CHtml::link(t('Ver Categoria'),array('/site/front/page/','view'=>$model->SLUG),array('target'=>'_blank','class'=>'bebutton','style'=>'width:63%;text-align: center;')); ?>
                        <?php endif; ?>
                    
                        
                </div>                                     
        </div>
</div>