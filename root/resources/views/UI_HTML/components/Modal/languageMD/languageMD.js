onMounted(() => {
    const openModal = document.getElementById('open-modal');
    const closeModal = document.getElementById('close-modal');
    const modalLang = document.getElementById('modal-lang');
    const modalContent = modalLang.querySelector('.md-content');

    openModal.addEventListener('click', () => {
        modalLang.classList.remove('hidden');
    });

    closeModal.addEventListener('click', (e) => {
        modalLang.classList.add('hidden');
        e.stopPropagation();
    });

    modalLang.addEventListener('click', () => {
        modalLang.classList.add('hidden');
    });

    // Ngăn sự kiện click lan ra ngoài khi click vào nội dung bên trong modal
    modalContent.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});