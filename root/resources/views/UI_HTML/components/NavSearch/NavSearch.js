onMounted(() => {
    const btnParentFocus = document.querySelectorAll('.focus-parent');
    const btnChildFocus = document.querySelectorAll('.focus-child');
    const btnCancel = document.querySelector('.btn-cancel');

    function hide() {
        btnChildFocus.forEach((child) => {
            child.classList.remove('open');
        });
    }

    btnParentFocus.forEach((btn, index) => {
        const child = btnChildFocus[index];
        btn.addEventListener('click', (e) => {
            e.stopPropagation(); // Ngăn chặn sự kiện lan truyền lên document
            hide();
            child.classList.toggle('open');
        });
    });

    btnCancel.addEventListener('click', function (event) {
        event.stopPropagation(); // Ngăn chặn sự kiện lan truyền lên document
        hide();
    });

    document.addEventListener('click', function (event) {
        event.stopPropagation(); // Ngăn chặn sự kiện lan truyền lên document
        hide();
    });
});