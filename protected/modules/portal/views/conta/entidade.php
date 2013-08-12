<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">
    
    <h1 class="page-title">
        <i class="icon-user icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => t('Entidade')." ".$model->NOME,
        'headerIcon' => 'icon-lock',
    )); ?>
        
        <style>
            dl.dl-horizontal dt,
            dl.dl-horizontal dd{
                margin-top: 10px;
            }
        </style>
        <dl class="dl-horizontal">
            <dt><?php echo $model->getAttributeLabel('NOME'); ?></dt>
            <dd><?php echo $model->NOME; ?></dd>
            <dt><?php echo $model->getAttributeLabel('EMAIL'); ?></dt>
            <dd><?php echo $model->EMAIL; ?></dd>
            <dt><?php echo $model->getAttributeLabel('NIF'); ?></dt>
            <dd><?php echo $model->NIF; ?></dd>
            <dt><?php echo $model->getAttributeLabel('LOCALIDADE'); ?></dt>
            <dd><?php echo $model->LOCALIDADE; ?></dd>
            <dt><?php echo $model->getAttributeLabel('COD_POSTAL'); ?></dt>
            <dd><?php echo $model->COD_POSTAL; ?></dd>
            <dt><?php echo $model->getAttributeLabel('RUA'); ?></dt>
            <dd><?php echo $model->RUA; ?></dd>
            <dt><?php echo $model->getAttributeLabel('TELEFONE'); ?></dt>
            <dd><?php echo $model->TELEFONE; ?></dd>
            <dt><?php echo $model->getAttributeLabel('TELEMOVEL'); ?></dt>
            <dd><?php echo $model->TELEMOVEL; ?></dd>
        </dl>
    
    <?php $this->endWidget();?>
    
</div>