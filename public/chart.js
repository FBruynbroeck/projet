$(document).ready(function(){

    $.ajax({
        type:'post',
        url:'/stat/total/json',
        dataType: 'json',
        success:function(response) {
            data = { datasets: [{ data: Object.values(response)}],
                labels: Object.keys(response)};
            var ctx = document.getElementById('chart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: data,
            });
        }
    });
});
