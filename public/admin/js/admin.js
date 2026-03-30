/* ================================================================
   VISAKHA DEFENCE ACADEMY — ADMIN PANEL JS
   File: public/admin/js/admin.js
================================================================ */

'use strict';

/* ================================================================
   SIDEBAR
================================================================ */
function toggleSidebar() {
    const sidebar = document.getElementById('vdaSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const main    = document.getElementById('vdaMain');

    if (window.innerWidth >= 992) {
        // Desktop: push main content
        sidebar.classList.toggle('desktop-collapsed');
        main.classList.toggle('sidebar-collapsed');
    } else {
        // Mobile: slide over
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }
}

function closeSidebar() {
    const sidebar = document.getElementById('vdaSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
}

document.getElementById('sidebarClose')?.addEventListener('click', closeSidebar);

// Close sidebar on ESC
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeSidebar();
});

/* ================================================================
   NAV GROUPS (Accordion dropdowns in sidebar)
================================================================ */
function toggleNavGroup(toggleEl) {
    const group = toggleEl.closest('.nav-group');
    const isOpen = group.classList.contains('open');

    // Close all groups
    document.querySelectorAll('.nav-group.open').forEach(g => {
        if (g !== group) g.classList.remove('open');
    });

    // Toggle current
    group.classList.toggle('open', !isOpen);
}

/* ================================================================
   ADMIN DROPDOWN (Topbar)
================================================================ */
function toggleAdminDropdown() {
    document.getElementById('adminDropdownMenu').classList.toggle('open');
}

// Close dropdown when clicking outside
document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('adminDropdownMenu');
    const btn = document.querySelector('.topbar-admin-btn');
    if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.remove('open');
    }
});

/* ================================================================
   IMAGE PREVIEW (file input → preview img)
================================================================ */
function initImagePreview(inputId, previewId) {
    const input   = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    if (!input || !preview) return;

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showToast('Please select a valid image file.', 'danger');
            this.value = '';
            return;
        }

        const maxMB = 5;
        if (file.size > maxMB * 1024 * 1024) {
            showToast(`Image must be under ${maxMB}MB.`, 'danger');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
}

// Auto-init all [data-preview] inputs on page load
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
        const previewId = input.getAttribute('data-preview');
        initImagePreview(input.id, previewId);
    });
});

/* ================================================================
   DRAG-AND-DROP SORT (SortableJS via CDN — loaded per page if needed)
   Fallback: simple up/down buttons
================================================================ */
function initSortable(listId, updateUrl) {
    const el = document.getElementById(listId);
    if (!el || typeof Sortable === 'undefined') return;

    Sortable.create(el, {
        handle: '.sort-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function () {
            const ids = [...el.querySelectorAll('[data-id]')].map(r => r.getAttribute('data-id'));
            fetch(updateUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ order: ids })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) showToast('Order saved!', 'success');
                else showToast('Failed to save order.', 'danger');
            })
            .catch(() => showToast('Network error.', 'danger'));
        }
    });
}

/* ================================================================
   CONFIRM DELETE
================================================================ */
function confirmDelete(url, message) {
    message = message || 'Are you sure you want to delete this? This action cannot be undone.';
    if (confirm(message)) {
        window.location.href = url;
    }
    return false;
}

// Attach to all [data-confirm-delete] links
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-confirm-delete]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            const msg = el.getAttribute('data-confirm-delete') || undefined;
            confirmDelete(el.getAttribute('href'), msg);
        });
    });
});

/* ================================================================
   TOAST NOTIFICATIONS
================================================================ */
function showToast(message, type) {
    type = type || 'success';

    const icons = {
        success: 'fas fa-check-circle',
        danger:  'fas fa-exclamation-circle',
        warning: 'fas fa-exclamation-triangle',
        info:    'fas fa-info-circle'
    };

    const colors = {
        success: '#198754',
        danger:  '#dc3545',
        warning: '#ffc107',
        info:    '#0dcaf0'
    };

    // Create container if not exists
    let container = document.getElementById('vda-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'vda-toast-container';
        container.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 360px;
        `;
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.style.cssText = `
        background: #fff;
        border-left: 4px solid ${colors[type] || colors.success};
        border-radius: 8px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        font-size: 13.5px;
        color: #334155;
        font-family: 'Inter', sans-serif;
        animation: slideIn 0.3s ease;
        min-width: 260px;
    `;

    toast.innerHTML = `
        <i class="${icons[type] || icons.success}" style="color:${colors[type]};font-size:16px;flex-shrink:0;"></i>
        <span style="flex:1;">${message}</span>
        <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:#94a3b8;font-size:14px;padding:0 2px;">
            <i class="fas fa-times"></i>
        </button>
    `;

    container.appendChild(toast);

    // Auto remove after 4s
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s';
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

/* ================================================================
   AUTO-DISMISS FLASH ALERTS
================================================================ */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.vda-alert').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

/* ================================================================
   TOGGLE STATUS (inline AJAX toggle for active/inactive)
================================================================ */
function toggleStatus(id, url, badgeEl) {
    fetch(url, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            if (badgeEl) {
                if (data.status == 1) {
                    badgeEl.className = 'vda-badge vda-badge-success';
                    badgeEl.textContent = 'Active';
                } else {
                    badgeEl.className = 'vda-badge vda-badge-danger';
                    badgeEl.textContent = 'Inactive';
                }
            }
            showToast('Status updated!', 'success');
        } else {
            showToast('Failed to update status.', 'danger');
        }
    })
    .catch(() => showToast('Network error.', 'danger'));
}

/* ================================================================
   CHAR COUNTER for textareas
================================================================ */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('textarea[maxlength]').forEach(function (textarea) {
        const max     = parseInt(textarea.getAttribute('maxlength'));
        const counter = document.createElement('small');
        counter.className = 'vda-form-hint text-end d-block';
        counter.textContent = `0 / ${max}`;
        textarea.insertAdjacentElement('afterend', counter);

        textarea.addEventListener('input', function () {
            const len = this.value.length;
            counter.textContent = `${len} / ${max}`;
            counter.style.color = len >= max * 0.9 ? '#dc3545' : '#94a3b8';
        });
    });
});

/* ================================================================
   CSS ANIMATION KEYFRAMES (injected once)
================================================================ */
(function () {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .sortable-ghost {
            opacity: 0.4;
            background: #e8f0fc !important;
        }
        .vda-sidebar.desktop-collapsed {
            width: 64px;
            overflow: hidden;
        }
        .vda-sidebar.desktop-collapsed .brand-line1,
        .vda-sidebar.desktop-collapsed .brand-line2,
        .vda-sidebar.desktop-collapsed .brand-line3,
        .vda-sidebar.desktop-collapsed .admin-details,
        .vda-sidebar.desktop-collapsed .nav-section-label,
        .vda-sidebar.desktop-collapsed .nav-item span,
        .vda-sidebar.desktop-collapsed .nav-group-toggle span,
        .vda-sidebar.desktop-collapsed .nav-arrow,
        .vda-sidebar.desktop-collapsed .nav-badge,
        .vda-sidebar.desktop-collapsed .nav-group-children {
            display: none !important;
        }
        .vda-sidebar.desktop-collapsed .nav-item,
        .vda-sidebar.desktop-collapsed .nav-group-toggle {
            justify-content: center;
            padding: 12px;
        }
        .vda-sidebar.desktop-collapsed .nav-icon { margin: 0; }
        .vda-main.sidebar-collapsed { margin-left: 64px; }
    `;
    document.head.appendChild(style);
})();

/* ================================================================
   WINDOW RESIZE — Reset sidebar state
================================================================ */
window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
        const sidebar = document.getElementById('vdaSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar) sidebar.classList.remove('open');
        if (overlay) overlay.classList.remove('active');
    }
});