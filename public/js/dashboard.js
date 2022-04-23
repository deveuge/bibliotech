window.addEventListener('load', function () {
    new Glider(document.querySelector('.glider'), {
        slidesToShow: 'auto',
        draggable: true,
        itemWidth: 180,
        arrows: {
            prev: '.glider-prev',
            next: '.glider-next'
        }
    })
})