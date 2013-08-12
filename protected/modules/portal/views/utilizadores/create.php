<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-user icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
     <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink'=>false,
        'links'=>array(t('Dashboard')=>$this->createUrl('/portal/'),
                       t('Utilizadores')=>$this->createUrl('/portal/utilizadores/index'),
                       $this->pageTitle),
    )); ?>
    
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'×', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true,), // success, info, warning, error or danger
        ),
    )); ?> 
    
    <?php 
    $headerButtons=array();
    $diabled=array();
    
    if(!$model->isNewRecord)
    {
        $headerButtons=array(
                array('class' => 'bootstrap.widgets.TbButtonGroup',
                        'buttons'=>array(
                                array('label'=>'Voltar', 'url'=> $this->createUrl('/portal/'.$this->ID.'/index'))
                        ),
                ),
            );
        
        $diabled=array('disabled'=>true);
    }
    ?>
    
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => t('Informação Básica'),
        'headerIcon' => 'icon-list-alt',
        'headerButtons' => $headerButtons,
    )); ?>
        
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'horizontalForm',
		'type'=>'horizontal',
	)); ?>
            <fieldset>
                
                <?php echo $form->dropDownListRow($model,'ID_TIPO', 
                        CHtml::listData(TipoUtilizador::model()->findAll(),'ID_TIPO','IDENTIFICACAO'),
                        array('id'=>'tipos-utilizador')); ?>
                
                <div id="entidades" style="<?php echo ($model->ID_TIPO!=3)? "display: none;": ""; ?>">
                    <?php echo $form->dropDownListRow($model,'ID_ENT', 
                            CHtml::listData(Entidade::model()->findAll(),'ID_ENT','NOME')); ?>
                </div>
                
                <?php echo $form->textFieldRow($model, 'NOME',$diabled); ?>

                <?php echo $form->textFieldRow($model, 'EMAIL',$diabled); ?>
                
                <?php echo $form->textFieldRow($model, 'TELEFONE',$diabled); ?>

                <?php echo $form->textFieldRow($model, 'TELEMOVEL',$diabled); ?>
                
                <?php if($model->isNewRecord): ?>
                    <p>Será enviada, após o registo, uma Palavra Passe para o Email que for introduzido.</p>
                <?php endif; ?>
            </fieldset>
            <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>t('Gravar'))); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>t('Cancelar'))); ?>
            </div>
    
        <?php $this->endWidget(); ?>
        
    <?php $this->endWidget();?>
    
</div><!--/span-->
<script language="javascript">
    
    $('#tipos-utilizador').change(function(){
        if($(this).val()==3)
            $('#entidades').show('swing');
        else
            $('#entidades').hide('swing');
        
    });
</script>