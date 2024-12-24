<script>
document.addEventListener('DOMContentLoaded', function () {
    const openModalBtn = document.getElementById('open-modal-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const modal = document.getElementById('default-modal');

    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    const selectedLang = localStorage.getItem('selectedLang');
    if (selectedLang) {
        document.querySelectorAll('[data-lang]').forEach(item => {
            if (item.getAttribute('data-lang') === selectedLang) {
                item.classList.add('active');
                item.querySelector('.checkmark').classList.add('opacity-100');
            }
        });
    }

    document.querySelectorAll('[data-lang]').forEach(item => {
        item.addEventListener('click', (event) => {
            const lang = item.getAttribute('data-lang');
            localStorage.setItem('selectedLang', lang);
            document.querySelectorAll('[data-lang]').forEach(link => {
                link.classList.remove('active');
                link.querySelector('.checkmark').classList.remove('opacity-100');
            });
            item.classList.add('active');
            item.querySelector('.checkmark').classList.add('opacity-100');
        });
    });
});

</script>
