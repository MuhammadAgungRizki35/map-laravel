import './bootstrap';

function toggleTheme() {
    const body = document.getElementById('mainBody');
    const isDark = body.classList.toggle('dark-mode');

    if (isDark) {
        body.style.background = 'linear-gradient(135deg, #1f1f1f, #3a3a3a)';
        body.style.color = 'white';
    } else {
        body.style.background = 'linear-gradient(135deg, #667eea, #764ba2)';
        body.style.color = 'white';
    }
}
