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
    
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => t('Palavra Passe'),
        'headerIcon' => 'icon-lock',
    )); ?>
    
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'horizontalForm',
		'type'=>'horizontal',
	)); ?>
            <fieldset>
                
                <?php echo $form->passwordFieldRow($model, 'old_password'); ?>

                <?php echo $form->passwordFieldRow($model, 'new_password'); ?>
                
            </fieldset>
            <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'icon'=>'icon-retweet icon-white','type'=>'primary', 'label'=>t('Alterar Senha'))); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>t('Cancelar'))); ?>
            </div>
    
        <?php $this->endWidget(); ?>
    
    <?php $this->endWidget();?>
    
</div>