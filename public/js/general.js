// Alertas
setTimeout(function() {
    $(".alert-dismissible").alert('close');
}, 4000);

// Tooltips
new bootstrap.Tooltip(document.body, {
    selector: '[data-bs-toggle="tooltip"]'
});
