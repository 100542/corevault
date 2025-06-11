const input = document.querySelector('input[name="search"]');
input.addEventListener('input', () => {
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(() => {
        input.form.submit();
    }, 500);
});
