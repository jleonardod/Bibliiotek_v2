<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/calendar.css" rel="stylesheet">
    <style>
      #external-events{
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
      }

      #external-events h4{
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
      }

      .external-events p{
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
      }

      .external-events p input{
        margin: 0;
        vertical-align: middle;
      }

      #calendar{
        margin: 0 auto;
        width: 100%;
        background-color: #FFFFFF;
        border-radius: 6px;
        box-shadow: 0 1px 2px #c3c3c3;
        -webkit-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
        -moz-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
        box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
      }
    </style>
  </head>
  <body id="page-top">
    <div id="wrapper">
      <?php
        include('../components/sidebar.php');
      ?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <?php
          include('../components/topbar.php');
          include('../components/content-dashboard.php');
          ?>
        </div>
      </div>
    </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <!--<script src="../../assets/js/demo/chart-area-demo.js"></script>-->
    <script src="../../assets/js/demo/chart-pie-demo.js"></script>
    <script src="../../assets/js/calendar.js"></script>
  </body>
</html>
<script>
  $(document).ready(function(){
    date = new Date();
    d = date.getDate();
    m = date.getMonth();
    y = date.getFullYear();

    $('#external-events div.external-event').each(function(){
      
      var eventObject = {
        title: $.trim($(this).text())
      };

      $(this).data('eventObject', eventObject);

      $(this).draggable({
        zIndex: 999,
        revert: true,
        revertDuration: 0
      });
    });

    var calendar = $('#calendar').fullCalendar({
      header:{
        left: 'title',
        right: 'prev,next'
      },
      editable: true, 
      firstDay: 1,
      selectable: true,
      defaultView: 'month',

      axisFormat: 'h:mm',
      columnFormat:{
        month: 'ddd',
        week: 'ddd d',
        day: 'ddd M/d',
        agendaDay: 'dddd d'
      },
      titleFormat:{
        month: 'MMMM',
        week: 'MMMM yyyy',
        day: 'MMMM yyyy',
      },
      allDaySlot: false,
      selectHelper: true, 
      droppable: true,
      drop: function(date, allDay){
        var originalEventObject = $(this).data('eventObject');
        var copiedEventObject = $.extend({}, originalEventObject);

        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;

        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        if($('#drop-remove').is(':checked')){
          $(this).remove();
        }
      },
      events: [
        /*{
          title: 'All Day Event',
          start: new Date(y, m, 1)
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d-3, 16, 0),
          allDay: false,
          className: 'info'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d+4, 16, 0),
          allDay: false, 
          className: 'info'
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          className: 'important'
        },
        {
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					className: 'important'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'https://ccp.cloudaccess.net/aff.php?aff=5188',
					className: 'success'
				}*/
      ],
    });

    $.ajax({
      url: "../../html/application/consultas/conteoClientes.php",
      contentType: false,
      cache: false,
      processData: false,
      success: function(data){
        resultado = JSON.parse(data);
        item = resultado['item'];
        mensaje = resultado['mensaje'];

        if(typeof item === 'undefined'){
          console.log("Error al traer los datos");
        }else{
          conteoClientes = item[0];
          conteoClientes = conteoClientes["conteoClientes"];
          $("#conteoClientes").html(conteoClientes);
        }
      }
    })

    $.ajax({
      url: "../../html/application/consultas/conteoUsuarios.php",
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(){
        $("#conteoUsuarios").html(
          `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
        );
      }, 
      success: function(data){
        resultado = JSON.parse(data);
        item = resultado['item'];
        mensaje = resultado['mensaje'];

        if(typeof item === 'undefined'){
          console.log("Error al traer los datos");
        }else{
          conteoUsuarios = item[0];
          conteoUsuarios = conteoUsuarios["conteoUsuarios"];
          $("#conteoUsuarios").html(conteoUsuarios);
        }
      }
    })

    $.ajax({
      url: "../../html/application/consultas/conteoLibros.php",
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(){
        $("#conteoLibros").html(
          `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
        );
      }, 
      success: function(data){
        resultado = JSON.parse(data);
        item = resultado['item'];
        mensaje = resultado['mensaje'];

        if(typeof item === 'undefined'){
          console.log("Error al traer los datos");
        }else{
          conteoLibros = item[0];
          conteoLibros = conteoLibros["conteoLibros"];
          $("#conteoLibros").html(conteoLibros);
        }
      }
    })
  });
</script>
<script>
  let labels = [];
  let cantidad = [];
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }

  $.ajax({
    url: "../../html/application/consultas/afiliadosAnio.php",
    contentType: false, 
    cache: false, 
    processData: false, 
    beforeSend: function(){
      $("#myAreaChart").html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
      );
    }, 
    success: function(data){
      resultado = JSON.parse(data);
      item = resultado['item'];
      mensaje = resultado['mensaje'];

      if(typeof item === 'undefined'){
        console.log("Error al traer los datos");
      }else{
        for(i = 0; i<12; i++){
          mes = item[i];
          afiliados = item[i];
          mes = mes["mes"];
          afiliados = afiliados["afiliados"];
          afiliados = parseInt(afiliados)
          labels.push(mes);
          cantidad.push(afiliados);
        }
      }
      labels = labels.reverse();
      cantidad = cantidad.reverse();
    }
  })

  // Area Chart Example
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: "Afiliaciones",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: cantidad,
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 7
          }
        }],
        yAxes: [{
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return '' + number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
          }
        }
      }
    }
  });

</script>