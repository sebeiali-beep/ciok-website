import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// ⚠️ Attendre que le DOM soit complètement chargé
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        Alpine.start();
    });
} else {
    Alpine.start();
}