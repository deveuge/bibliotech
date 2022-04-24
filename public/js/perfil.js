/* Cargar favoritos */
$("#cargar-mas").on("click", function(e) {
    jaxon_cargarFavoritos(username, $(this).attr("data-page"));
    $(this).attr("data-page", parseInt($(this).attr("data-page")) + 1);
});

$("body").on("click", ".eliminar-favorito", function(e) {
    jaxon_eliminarFavorito($(this).attr("data-isbn"));
    $('[data-bs-toggle="tooltip"]').tooltip('hide');
    $('#contador-favoritos').text(parseInt($('#contador-favoritos').text()) - 1);
});

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

/* Categorías favoritas */
new Chart(document.getElementById('chart-categorias').getContext('2d'), {
    type: 'pie',
    data: {
        labels: categoriasFavoritasNombres,
        datasets: [{
            data: categoriasFavoritasValores,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)'
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

/* Libros leídos */
new Chart(document.getElementById('chart-leidos').getContext('2d'), {
    type: 'bar',
    data: {
        labels: librosLeidosNombres,
        datasets: [{
            data: librosLeidosValores,
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
            ],
            barPercentage: 0.5,
            borderRadius: 5
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});