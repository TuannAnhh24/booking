onMounted(() => {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdown');

    dropdownButton?.addEventListener('click', function () {
        if (dropdownMenu?.classList.contains('hidden')) {
            dropdownMenu?.classList.remove('hidden');
            dropdownMenu?.classList.add('block');
        } else {
            dropdownMenu?.classList.remove('block');
            dropdownMenu?.classList.add('hidden');
        }
    });
});