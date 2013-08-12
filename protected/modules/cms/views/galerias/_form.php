<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'galeria-form',
        'enableAjaxValidation'=>false,
)); ?>
    <div class="closed-box content-box">
        <div class="content-box-header">
            <h3><?php echo t('Dados Gerais');?></h3>                             
        </div> 
        <div class="content-box-content" style="display: block;">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldRow($model,'NOME',array('style'=>'width:50%;','maxlength'=>255)); ?>

            <?php echo $form->textFieldRow($model,'DESCRICAO',array('style'=>'width:50%;','maxlength'=>255)); ?>

            <div class="form-actions">
                    <?php echo CHtml::submitButton($model->isNewRecord ? t('Adicionar') : t('Gravar'),array('name'=>'save','class'=>'bebutton')); ?>
            </div>                                   
        </div>
    </div>

<?php $this->endWidget(); ?>


<?php if(!$model->isNewRecord): ?>
    <div class="closed-box content-box">
        <div class="content-box-header">
            <h3><?php echo t('Imagens');?></h3>                             
        </div> 
        <div class="content-box-content" style="display: block;">

            <?php $this->widget('xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("/cms/media/upload", array("id_galeria" => $model->ID_GALERIA)),
                    'model' => $xmodel,
                    'attribute' => 'file',
                    'multiple' => false,
            ));
            ?>
            
            <?php $this->widget('ext.fancybox.EFancyBox', array(
                'target'=>'a[rel=gallery]',
                'config'=>array(),
                )
            ); ?>

            <ul class="thumbnails">
                <?php foreach($imagens as $key =>$image): ?>

                    <li class="span3">
                        <a href="<?php echo $image['image']; ?>" class="thumbnail" rel="gallery" data-title="<?php echo $image['name']; ?>" >
                            <img src="<?php echo $image['image']; ?>" alt="">
                        </a>
                    </li>  

                <?php endforeach; ?>
            </ul>
            
        </div>
    </div>
<?php endif; ?>


