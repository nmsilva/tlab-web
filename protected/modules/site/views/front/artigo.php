<?php $noticia=($artigo->CAT_OBJETO->ID_CAT==6)?TRUE:FALSE; ?>

<?php $noticias=($noticia)?$noticias=array('name' => 'NOTICIAS', 'url' => array('/site/front/page/view/noticias')):null;?>

<?php if(!$noticia): ?>

    <?php $this->widget('application.modules.site.components.TitleWidget', array(
      'crumbs' => array(
        $noticias,
        array('name' => $model->TITULO),
      ),
      'title' => $model->TITULO, 
    )); ?>

<?php endif;?>

<div class="box-jfontsize one" style="width: 98%;">
    <a class="jfontsize-button" id="jfontsize-m" href="#">A-</a>
    <a class="jfontsize-button" id="jfontsize-d" href="#">A</a>
    <a class="jfontsize-button" id="jfontsize-p" href="#">A+</a>
</div>

<div class="main <?php echo ($noticia)?"two":"one"; ?>">
    
    <?php if($noticia): ?>
        
        <div class="blog-item-holder">
       
                <div class="gdl-blog-full">
                    <div class="blog-content-wrapper">
                        <div class="blog-info-wrapper">
                            <h3 class="blog-title">
                                <?php echo $model->TITULO; ?>
                            </h3>
                            <div class="blog-date-wrapper">
                                <a href="<?php echo $this->createUrl('/site/front/page/view/noticias/',array('d'=>substr($artigo->DATA_CRIACAO, 0, 7))); ?>">
                                    <?php echo $artigo->DATA_CRIACAO; ?>
                                </a>
                            </div>
                            <div class="blog-tag">
                                <a href="<?php echo $this->createUrl('/site/front/page/view/noticias/',array('tag'=>'people')); ?>" rel="tag">people</a>
                            </div>
                            <div class="clear">

                            </div>

                        </div>
                        <?php if($artigo->IMAGEM): ?>
                            <div class="blog-media-wrapper gdl-image">
                                <img src="<?php echo Media::model()->getPublicUrl()."/".$artigo->IMAGEM->PATH; ?>" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="blog-content text">
                            <?php echo $model->CONTENT; ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                
        </div>
    
    <?php else: ?>
        <div class="text">
            <?php echo $model->CONTENT; ?>
        </div>
    <?php endif;?>
</div>
<?php if($noticia): ?>
    <div class="side">
    
    </div>
<?php endif; ?>

<script type="text/javascript" language="javascript">
    $('.text').jfontsize({
        btnMinusClasseId: '#jfontsize-m',
        btnDefaultClasseId: '#jfontsize-d',
        btnPlusClasseId: '#jfontsize-p',
        btnMinusMaxHits: 1,
        btnPlusMaxHits: 3,
        sizeChange: 2
    });
</script>


