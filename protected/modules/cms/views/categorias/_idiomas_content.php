<?php $new=false;?>

<?php if(!isset($form)): $new=true;?>
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'categorias-form',
	'enableAjaxValidation'=>false,
    )); ?>
<?php endif;?>
        
    <?php echo $form->textFieldRow($categoria_idioma,'TITULO',array('class'=>'span5','maxlength'=>255,'id'=>'txt_title')); ?>

    <?php echo $form->textAreaRow($categoria_idioma,'DESCRICAO',array('style'=>'height:150px','class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textAreaRow($categoria_idioma,'KEYWORDS',array('class'=>'span5','maxlength'=>255)); ?>
    
<?php 
if($new)
    $this->endWidget();
?>