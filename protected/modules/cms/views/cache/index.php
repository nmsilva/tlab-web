<div class="form">
<?php $this->renderPartial('application.modules.cms.components.views.notification'); ?>
<a class="button" href="<?php echo bu();?>/cms/cache/clear?cache_id=assets"><?php echo t('Limpar Assets'); ?></a>
<a class="button" href="<?php echo bu();?>/cms/cache/clear?cache_id=cache"><?php echo t('Limpar Cache'); ?></a>
</div>