<?php 
	//include koneksi
	include "koneksi.php";

    //baca data dengan ID tertinggi
    $sql_id = mysqli_query($konek, "SELECT MAX(id) FROM tb_gas");

    //ambil data
    $data_id = mysqli_fetch_array($sql_id);
    //ambil data terakhir yang masuk 
    $id_akhir = $data_id['MAX(id)']; //data terakhr
    $id_awal  = $id_akhir - 29 ; // 25 data terakhir (id_akhir dan (nomor) id sebelumnya)

	//baca data dari tb_sensor
	//baca informasi tanggal untuk 20 data terakhir -- sumbu X di Grafik-- 
	$tanggal = mysqli_query($konek, "SELECT tanggal FROM tb_gas WHERE id>='$id_awal' and id<='$id_akhir' ORDER BY ID ASC");

	//baca informasi GAS untuk 20 data terakhir -- sumbu Y di Grafik-- 
	$gas = mysqli_query($konek, "SELECT gas FROM tb_gas WHERE id>='$id_awal' and id<='$id_akhir' ORDER BY ID ASC");

 ?>

    <script src="vendor/highchart/highcharts.js"></script>
   
    

    <style type="text/css">
        #myGrafik {
    align-content: center;        
    height: 400px; 
        }

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 500px;
    margin: 2em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 1.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}       
    </style>

<script type="text/javascript">
 Highcharts.chart('myGrafik', {
    chart: {
        type: 'area'
    }, 
    title: {
        text: ''
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        categories: [
                    <?php 
                    while ($data_tanggal = mysqli_fetch_array($tanggal)) {
                            echo '"'.$data_tanggal['tanggal'].'",';
                         }
                     ?>

            ],
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Intesitas'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: '  '
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },
    series: [{
        name: 'Intensitas Gas',
        data: [<?php 
                    while ($data_gas = mysqli_fetch_array($gas)) {
                            echo $data_gas['gas'].',';
                         }
                     ?>]
    }]
});

</script>