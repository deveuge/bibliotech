let tabEl = document.querySelector('#estadisticas-tab')
tabEl.addEventListener('shown.bs.tab', function (event) {
    /* Contadores */
    $('.count-numbers').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
})

const myChart = new Chart(document.getElementById('chart-categorias').getContext('2d'), {
    type: 'pie',
    data: {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            data: [300, 50, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'right'
            }
        }
    }
});

const myChart2 = new Chart(document.getElementById('chart-leidos').getContext('2d'), {
    type: 'bar',
    data: {
        labels: [
            'JAN',
            'FEB',
            'MAR',
            'APR',
            'MAY',
            'JUN',
            'JUL'
        ],
        datasets: [{
            data: [1, 4, 2, 1, 0, 3, 1],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            barPercentage: 0.5,
            borderRadius: 5
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});