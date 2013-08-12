<a href="#" id="sel-lang"><?php echo CHtml::image(Yii::app()->getAssetManager()->publish(Yii::app()->getModule('site')->getBasePath()."/assets/images/bandeiras/".$current->BANDEIRA),"image"); ?></a>
<ul class="more-lang">
<?php foreach ($idiomas as $key => $idioma): ?>
    
    <?php if($idioma->LANG_ID!=$this->lang): ?>
        <li><a href="<?php echo $this->getOwner()->createMultilanguageReturnUrl($idioma->SHORT);?>" ><?php echo CHtml::image(Yii::app()->getAssetManager()->publish(Yii::app()->getModule('site')->getBasePath()."/assets/images/bandeiras/".$idioma->BANDEIRA),"image"); ?> </a></li>
    <?php endif; ?>
        
<?php endforeach; ?>
</ul>

