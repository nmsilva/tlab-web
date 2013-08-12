<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-user icon-white"></i>
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
    
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        )); ?>
    
        <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Informação Básica'),
            'headerIcon' => 'icon-list-alt',
        )); ?>
    
            <fieldset>
                
                <?php echo $form->textFieldRow($model, 'NOME'); ?>

                <?php echo $form->textFieldRow($model, 'EMAIL'); ?>

                <?php echo $form->textFieldRow($model, 'TELEFONE'); ?>

                <?php echo $form->textFieldRow($model, 'TELEMOVEL'); ?>
                
            </fieldset>

        <?php $this->endWidget(); ?>
    
        <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => t('Imagem de Perfil'),
            'headerIcon' => 'icon-user',
        )); ?>
            <ul class="thumbnails" style="margin-bottom: 0;">
                <li>
                    <a class="thumbnail" onclick="return false;" href="#">
                        <?php if(!empty($model->IMAGEM)):?>
                            <img src="<?php echo Helper::getFotoPublicUrl()."/".$model->IMAGEM; ?>" width="80" height="80">
                        <?php else: ?>
                            <img id="image_normal" src="<?php echo $this->module->assetsUrl; ?>/images/user_80x80.jpg">
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
            <?php echo $form->fileField($foto, 'file',array('style'=>'')); ?>
            <p>Your picture can have a maximum size of 0.5 MB and these formats: jpeg, gif or png. You will get best result using a 100x100 pixel picture.</p>
            
        <?php $this->endWidget();?>
            
        <div class="form-actions" style="padding-left: 0;">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>t('Gravar Alterações'))); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>t('Cancelar'))); ?>
        </div>
    <?php $this->endWidget();?>
    
</div><!--/span-->