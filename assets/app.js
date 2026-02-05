import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

function initThemeToggle() {
    const toggle = document.getElementById('theme-toggle');
    const html = document.documentElement;

     if (!toggle) {
        return;
    }

    if (toggle.dataset.themeBound === 'true') {
        // Par contre on met à jour l'icône selon le thème courant
        const current = html.getAttribute('data-theme') || 'light';
        toggle.textContent = current === 'dark' ? '☀️' : '🌙';
        return;
    }
    // Charger le thème sauvegardé
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        html.setAttribute('data-theme', savedTheme);
        toggle.textContent = savedTheme === 'dark' ? '☀️' : '🌙';
    } else {
        html.setAttribute('data-theme', 'light');
        toggle.textContent = '🌙';
    }

    toggle.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-theme') || 'light';
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';

        html.setAttribute('data-theme', nextTheme);
        localStorage.setItem('theme', nextTheme);
        toggle.textContent = nextTheme === 'dark' ? '☀️' : '🌙';
    });
        toggle.dataset.themeBound = 'true';
}

document.addEventListener('DOMContentLoaded', initThemeToggle);

document.addEventListener('turbo:load', initThemeToggle);