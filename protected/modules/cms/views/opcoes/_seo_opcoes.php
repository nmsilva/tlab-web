<?php $new=false;?>

<?php if(!isset($form)): $new=true;?>
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'categorias-form',
	'enableAjaxValidation'=>false,
    )); ?>
<?php endif;?>
    
    <?php echo CHtml::label(t('Título: '), 'opcoes['.$lang.'_title]')?>
    <?php echo CHtml::textField('opcoes['.$lang.'_title]',Opcoes::model()->getSEOProperty('title',$lang))?>

    <?php echo CHtml::label(t('Descrição: '), 'opcoes['.$lang.'_desc]')?>
    <?php echo CHtml::textArea('opcoes['.$lang.'_desc]',Opcoes::model()->getSEOProperty('desc',$lang),array('style'=>'height:150px'))?>

    <?php echo CHtml::label(t('Palavras Chave: '), 'opcoes['.$lang.'_keywords]')?>
    <?php echo CHtml::textArea('opcoes['.$lang.'_keywords]',Opcoes::model()->getSEOProperty('keywords',$lang))?>
    
<?php 
if($new)
    $this->endWidget();
?>