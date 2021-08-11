function datos(){
  let asignacion = [];

  $.ajax({
    url: "../../html/application/consultas/asignacionLibros.php",
    contentType: false, 
    cache: false,
    processData: false,
    success: function(data){
      resultado = JSON.parse(data);
      item = resultado["item"];
      mensaje = resultado["mensaje"];

      for(i = 0; i<item.length; i++){
        cantidad = item[i];
        cantidad = cantidad["cantidad"];
        
        asignacion.push(cantidad);
      }
    }
  })

  return (asignacion);
}

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Librerias", "Biblioteca"],
    datasets: [{
      data: datos(),
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
