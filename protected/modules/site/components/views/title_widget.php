<div id="title-page">

    <!-- begin wrapper-->
    <section class="wrapper">
        <div class="row">
            <div class="span12">
              <div class="row">
                <div class="span6">
                    <h2><?php echo $this->title; ?></h2>
                </div>
                <div class="span4">
                    <ul class="crumbs">
                            <?php
                                $crumbs=array('name' => t('INICIO'), 'url' => array('/site/front'));
                                array_unshift($this->crumbs,$crumbs);

                                foreach($this->crumbs as $key => $crumb) {
                                       if($crumb)
                                       {
                                            if(isset($crumb['url'])) {
                                                echo "<li>".CHtml::link($crumb['name'], $crumb['url'])."</li>";
                                            } else {
                                                echo "<li><span>".$crumb['name']."</span></li>";
                                            }

                                            if($crumb!=end($this->crumbs)) {
                                                echo "<li><span class='divider'>>></span></li>";
                                            }
                                       }
                                   }
                            ?>

                    </ul>
                    
                </div>
              </div>
            </div>
        </div>

    </section>
    <!-- end wrapper-->

</div>