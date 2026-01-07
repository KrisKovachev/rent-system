import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-toggle-role]').forEach(form => {
        const checkbox = form.querySelector('input[type="checkbox"]');

        checkbox.addEventListener('change', async () => {
            const originalState = checkbox.checked;

            try {
                const response = await fetch(form.action, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error('Request failed');
                }

            } catch (e) {
                // rollback UI ако нещо гърми
                checkbox.checked = !originalState;
                alert('Failed to update role');
            }
        });
    });
});
