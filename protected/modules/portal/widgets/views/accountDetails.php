<div class="account-container">
                
    <div class="account-avatar">
        <?php if(!empty($model->IMAGEM)):?>
            <img src="<?php echo Helper::getFotoPublicUrl()."/".$model->IMAGEM; ?>" class="thumbnail">
        <?php else: ?>
            <img id="image_normal" src="<?php echo $this->getController()->module->assetsUrl; ?>/images/user_80x80.jpg" class="thumbnail">
        <?php endif; ?>
    </div> <!-- /account-avatar -->

    <div class="account-details">
        <span class="account-name"><?php echo user()->name; ?></span>

        <span class="account-role"><?php echo getNameAccountRole(user()->rule); ?></span>

        <span class="account-actions">
            <a href="<?php echo Yii::app()->getUrlManager()->createUrl('/portal/conta/index'); ?>"><?php echo t('Definições de Conta');?></a>
        </span>

    </div> <!-- /account-details -->

</div>