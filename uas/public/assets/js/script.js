document.addEventListener('DOMContentLoaded', function() {
    /* ===== Flash Messages → Toast ===== */
    document.querySelectorAll('.alert').forEach(function(el) {
        var type = el.classList.contains('alert-success') ? 'success' : 'error';
        showToast(el.textContent.trim(), type);
        el.style.display = 'none';
    });

    /* ===== Auto-hide Flash (legacy) ===== */
    var flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(function(msg) {
        setTimeout(function() {
            msg.style.transition = 'opacity 0.5s';
            msg.style.opacity = '0';
            setTimeout(function() { msg.remove(); }, 500);
        }, 3000);
    });

    /* ===== Confirmation Modal ===== */
    window.confirmAction = function(msg, callback) {
        var existing = document.querySelector('.confirm-overlay');
        if (existing) existing.remove();

        var overlay = document.createElement('div');
        overlay.className = 'confirm-overlay';
        overlay.innerHTML =
            '<div class="confirm-modal">' +
            '<div class="confirm-icon">' +
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>' +
            '</div>' +
            '<div class="confirm-msg">' + msg + '</div>' +
            '<div class="confirm-actions">' +
            '<button class="btn btn-secondary" id="confirm_no">Batal</button>' +
            '<button class="btn btn-primary" id="confirm_yes">Yakin</button>' +
            '</div>' +
            '</div>';
        document.body.appendChild(overlay);

        document.getElementById('confirm_yes').addEventListener('click', function() {
            overlay.remove();
            if (callback) callback();
        });
        document.getElementById('confirm_no').addEventListener('click', function() {
            overlay.remove();
        });
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) overlay.remove();
        });
    };

    /* ===== Replace native confirm() ===== */
    document.querySelectorAll('[onclick*="confirm("]').forEach(function(el) {
        var match = el.getAttribute('onclick').match(/confirm\(['"](.+?)['"]\)/);
        if (match) {
            var msg = match[1];
            var href = el.getAttribute('href');
            if (href) {
                el.removeAttribute('onclick');
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    confirmAction(msg, function() { window.location.href = href; });
                });
            }
        }
    });
});

/* ===== Toast System ===== */
function showToast(msg, type) {
    type = type || 'error';
    var container = document.getElementById('toast-container');
    if (!container) return;

    var toast = document.createElement('div');
    toast.className = 'toast toast-' + type;

    var icon = type === 'success'
        ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>'
        : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>';

    toast.innerHTML = icon + '<span>' + msg + '</span>';
    container.appendChild(toast);

    setTimeout(function() {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(function() { toast.remove(); }, 300);
    }, 3500);
}
