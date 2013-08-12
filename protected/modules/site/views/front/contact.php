<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

?>
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

    </section>
    <!-- end wrapper-->

    <!-- map of location-->
    <div id="map"></div>

    <!-- begin wrapper-->
    <section class="wrapper">
        <div id="content" class="contact-us">
            <ul>
                <li class="marker">
                    Rua Ponte de Pau,<br> 19 – R/C Portugal
                </li>
                <li class="mail">info@email.pt</li>
                <li class="phone">(+351) 232 --- --- </li>
            </ul>

            <div class="sub-title">
                <h4>Envie-nos uma Mensagem</h4>
            </div>

            <div class="contact-form">
                <form action="" method="post">
                    <div class="row">
                        <div class="span5">
                            <div class="row">
                                <div class="span1">
                                    <span>Empresa</span>
                                </div>
                                <div class="span4">
                                    <input type="text" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="span1">
                                    <span>Nome</span>
                                </div>
                                <div class="span4">
                                    <input type="text" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="span1">
                                    <span>Email</span>
                                </div>
                                <div class="span4">
                                    <input type="text" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="span1">
                                    <span>Assunto</span>
                                </div>
                                <div class="span4">
                                    <input type="text" >
                                </div>
                            </div>
                        </div>
                        <div class="span5">

                            <div class="row">
                                <div class="span1">
                                    <span>Mensagem</span>
                                </div>
                                <div class="span4">
                                    <textarea></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="span1"></div>
                                <div class="span4">
                                    <button class="btn" type="submit">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>  
            </div>

        </div>
    </section>
    <!-- end wrapper-->

</section>
<!-- end main-->

<!-- Gmaps library -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.gmap.min.js"></script>

<script language="javascript">

$(document).ready(function() {
    /* ---------------------------------------------------------------------- */
    /*  Google Maps
    /* ---------------------------------------------------------------------- */

    // Needed variables
    var $map                = $('#map'),
        $address            = 'Rua Ponte de Pau, 19 – R/C · Portugal';


    $map.gMap({
            address: $address,
            zoom: 16,
            scrollwheel: false,
            markers: [
                    { 'address' : $address }
            ]
    });
});

</script>