onMounted(() => {
    const openModalMoney = document.getElementById('open-modal-money');
    const closeModalMoney = document.getElementById('close-modal-money');
    //  modal
    const modal = document.getElementById('money-modal');
    //  modal-content
    const modalContent = modal.querySelector('.md-content');

    openModalMoney.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModalMoney.addEventListener('click', (e) => {
        modal.classList.add('hidden');
        e.stopPropagation();
    });

    modal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Ngăn sự kiện click lan ra ngoài khi click vào nội dung bên trong modal
    modalContent.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});