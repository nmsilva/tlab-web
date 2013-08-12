<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'media-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<div class="form-wrapper">
    <div id="form-sidebar">
        
        <!--Start the publish Box -->
        <div class="content-box">

                <div class="content-box-header">
                    <h3><?php echo t('Visualização'); ?></h3>
                </div> 

                <div class="content-box-content" style="display: block;">

                        <div class="tab-content default-tab" style="display: block;">
                            <?php if($model->TYPE==0): ?>
                                <?php echo CHtml::image(Media::model()->getPublicUrl()."/".$model->PATH,"image",array('width'=>'250px','height'=>'150px')); ?>
                            <?php elseif($model->TYPE==1): ?>
                            <?php endif; ?>                            
                            
                        </div>       

                </div>


        </div>
        <!-- End Publish Box -->
        
        <?php foreach($terms as $key=>$term) :    
            
            $this->widget('application.modules.cms.components.SidebarItemsWidget',array(
                'form'=>$form,
                'model'=>$model,
                'term'=>$term,
                'selected_terms'=>$selected_terms,
                'key'=>$key
                )); 
       endforeach; ?>

    </div>
    <div id="form-body">
            <div id="form-body-content">
                    
                    <div class="closed-box content-box">
                            <div class="content-box-header">
                                <h3><?php echo t('Dados Gerais');?></h3>                             
                            </div> 
                            <div class="content-box-content" style="display: block;">

                                    <div class="tab-content default-tab" id="extra_box">
                                        
                                        <?php echo $form->textFieldRow($model,'NOME',array('class'=>'span5','maxlength'=>255)); ?>
                                        
                                        <label><?php echo t('URL da Imagem'); ?></label>
                                        <?php $url="http://".$_SERVER['HTTP_HOST'].Media::model()->getPublicUrl()."/".$model->PATH;?>
                                        <span><?php echo CHtml::link($url, $url,array('target'=>'_blank')); ?></span>
                                        <br><br>
                                        <?php echo $form->textAreaRow($model, 'BODY', array('class'=>'span8', 'rows'=>5)); ?>
                                                                                
                                        <?php echo $form->labelEx($model,'PATH'); ?>
                                            
                                                                                
                                    </div>                                     
                            </div>
                    </div>

                    <div class="form-actions">
                            <?php echo CHtml::submitButton($model->isNewRecord ? t('Adicionar') : t('Gravar'),array('name'=>'save','class'=>'bebutton')); ?>
                            <?php echo CHtml::submitButton(t('Finalizar'),array('name'=>'end','class'=>'bebutton')); ?>
                    </div>
            </div>
    </div>
						
</div>

<?php $this->endWidget(); ?>
