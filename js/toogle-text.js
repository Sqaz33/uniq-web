function toggleText(button) {
    var container = button.closest('.hide_text');
    container.classList.toggle('expanded');

    if (container.classList.contains('expanded')) {
        button.textContent = "Скрыть";
    } else {
        button.textContent = "Читать полностью";
    }
}