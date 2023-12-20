document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const etoileValue = document.getElementById('etoileValue');

    stars.forEach(star => {
        star.addEventListener('mouseover', function () {
            const value = this.getAttribute('data-value');

            stars.forEach((s, index) => {
                s.classList.remove('active');
                if (index < value) {
                    s.classList.add('active');
                }
            });
        });

        star.addEventListener('mouseout', function () {
            const activeValue = etoileValue.value;

            stars.forEach((s, index) => {
                s.classList.remove('active');
                if (index < activeValue) {
                    s.classList.add('active');
                }
            });
        });

        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            etoileValue.value = value;
        });
    });

    const villeInput = document.getElementById('villeInput');
    const codepostalInput = document.getElementById('codepostal');
    const htmlElements = document.getElementById('html_elements');

    villeInput.addEventListener('input', function () {
        const selectedOption = htmlElements.querySelector(`option[value="${this.value}"]`);
        if (selectedOption) {
            this.setAttribute('data-nom', selectedOption.getAttribute('data-nom'));
        }
    });
    villeInput.addEventListener('change', function () {
        const selectedOption = htmlElements.querySelector(`option[value="${this.value}"]`);
        if (selectedOption) {
            const codepostal = selectedOption.getAttribute('data-codepostal');
            codepostalInput.value = codepostal || '';
        }
    });
});