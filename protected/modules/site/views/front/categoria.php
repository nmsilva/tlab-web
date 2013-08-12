<!-- begin main-->
<section id="content-body">

    <?php $this->widget('application.modules.site.components.TitleWidget', array(
      'crumbs' => array(
        array('name' => $cat_idioma->TITULO),
      ),
      'title' => $cat_idioma->TITULO, 
    )); ?>

    <!-- begin wrapper-->
    <section class="wrapper">
        <div id="slideshow-shadow" class="triangle-green"></div>

        <div id="content">
            <div class="sub-title">
                <h4><?php echo $model->TITULO; ?></h4>
            </div>
            <div id="target">  
                <?php echo $model->CONTENT; ?>
            </div>
        </div>
    </section>
    <!-- end wrapper-->
</section>
<!-- end main-->
