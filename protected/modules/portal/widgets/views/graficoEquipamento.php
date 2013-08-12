<div style="min-height: 200px;">
    
    <div class="loading-main"></div>
    
    <div id="grafico" style="display:none; width: 100%;height: 400px;">
        
     <?php $this->Widget('ext.highcharts.HighchartsWidget', array(
        'options'=>array(
           'chart'=>array('type'=>'spline',
                          'marginRight'=> 10,
                          'events'=>
                            array('load'=>'js:requestData')),
           'title' => array('text' => $this->model->IDENTIFICACAO),
           'xAxis' => array(
               'type'=>'datetime',
               'tickPixelInterval'=>'150',
               'data' => array('0','0','0','0','0','0','0')
           ),
           'yAxis' => array(
              'title' => array('text' => t('Tempo')),
           ),
           'tooltip'=>array(
                'formatter'=>'js:function() {
                                     return "<b>"+ this.series.name +"</b><br/>"+
                                     Highcharts.dateFormat("%Y-%m-%d %H:%M:%S", this.x) +"<br/>"+
                                     Highcharts.numberFormat(this.y, 2);
                             }',
            ),
           'legend'=>array('enabled'=>'false'),
           'exporting'=>array('enabled'=>'false'),
           'series' => $sensores,
        )
     )); ?>
    
    </div>
    
    <?php Yii::app()->clientScript->registerScript('1','function requestData() {
            $.ajax({
                url: "'.CController::createUrl("/portal/metricas/equip/id").'/'.$this->model->ID_EQUIP.'",
                success: function(result) {
                                                           
                    if(result!="false"){
                            chart.setSize(
                                $("#grafico").width(), 
                                $("#grafico").height(),
                                false
                            );

                            $(".loading-main").hide();
                            $("#grafico").show();
            
                        var series = chart.series[0],
                        shift = series.data.length > 1; // shift if the series is longer than 20
                        
                        $.each( result.POINTS, function( key, value ) {
                            console.log(key);
                            chart.series[key].addPoint(value, true, shift);
                        });
                    }
                    else{
                        $(".loading-main").show();
                        $("#grafico").hide();
                        
                    }

                    // call it again after one second
                    setTimeout(requestData, 1000); 
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    location.reload();
                },
                cache: false
               });
        }',CClientScript::POS_LOAD); ?>
</div>
