const forms = document.querySelectorAll('form');

forms.forEach(function (form) {
    form.addEventListener('reset', function () {
        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(function (input) {
            input.classList.remove('is-valid', 'is-invalid'); // Hapus kelas validasi
        });

        const feedbackElements = form.querySelectorAll('.valid-feedback, .invalid-feedback');
        feedbackElements.forEach(function (feedback) {
            feedback.style.display = '';
        });
    });
});
