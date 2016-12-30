<?php $__env->startSection('placeholder'); ?>
<h1 class="display-1 hidden-xs-down">Dashboard</h1>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="card card-inverse card-success">
            <div class="card-block bg-success">
                <div class="rotate">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Users</h6>
                <h1 class="display-1"><?php echo e($counts['users']); ?></h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="card card-inverse card-danger">
            <div class="card-block bg-danger">
                <div class="rotate">
                    <i class="fa fa-bolt fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Sockets</h6>
                <h1 class="display-1"><?php echo e($counts['sockets']); ?></h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="card card-inverse card-info">
            <div class="card-block bg-info">
                <div class="rotate">
                    <i class="fa fa-lightbulb-o fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Lights</h6>
                <h1 class="display-1"><?php echo e($counts['lights']); ?></h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="card card-inverse card-warning">
            <div class="card-block bg-warning">
                <div class="rotate">
                    <i class="fa fa-microchip fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Sensors</h6>
                <h1 class="display-1"><?php echo e($counts['sensors']); ?></h1>
            </div>
        </div>
    </div>
</div>

<hr>

<canvas id="canvas" height="100"></canvas>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('lazyload'); ?>
<script>


var color = Chart.helpers.color;
var barChartData = {};

var barChartData = {
    labels: [],
    datasets: [{
        label: 'Room: name',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [
        ]
    }]

};

window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");

    window.myBar = new Chart(ctx, {
        type: 'line',
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Avg temperature for all rooms'
            }
        }
    });
};

var colorNames = Object.keys(window.chartColors);


function addData(value, label) {
    if (barChartData.datasets.length > 0) {
        if(barChartData.labels.length >= 50) {
          barChartData.labels.shift();
        }

        barChartData.labels.push(label);

        for (var index = 0; index < barChartData.datasets.length; ++index) {
            if(barChartData.datasets[index].data.length >= 50) {
              barChartData.datasets[index].data.shift();
            }

            barChartData.datasets[index].data.push(value);
        }

        window.myBar.update();
    }
}

$('#dialogToolbar').ajax_callback('/dashboard/temperature_chart', {
}, {
  callback_success: function(data) {

    $.each(data.content, function(inx, val) {
      var label = val.date.year +'-'+ val.date.month +'-'+ val.date.day +' '+ val.date.hour +':'+ val.date.interval;
      addData(val.temp,label)
    })
  }
});

// setInterval(addData, 1000);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>