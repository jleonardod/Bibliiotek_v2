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
    <script src="../../assets/js/demo/chart-area-demo.js"></script>
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
  });
</script>