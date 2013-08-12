<?php //print_r($result); ?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script language="javascript">
    var chart; 
    var series= <?php echo json_encode($series['series']); ?>;
    var plotBands=<?php echo json_encode($series['plotbands']); ?>;
        
    $(document).ready(function() {
                        chart = new Highcharts.StockChart({
            chart: {
                renderTo: 'container',
                type: 'line'
            },
            title: {
                text: 'Gráfico',
                x: -20 //center
            },
            rangeSelector : {
                selected : 1
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 100
            },
            yAxis: {
                title: {
                    text: 'Valor '
                },
                plotBands: plotBands

            },
            tooltip: {
                formatter: function() {
                        return '<b>'+
                        Highcharts.dateFormat('%A, %b %e, %Y %H:%M:%S', this.x) +'</b><br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            series: series
        });
    });
    
    
 

</script>

<div id="container" style="min-width: 400px; height: 400px; margin: 20px;"></div>