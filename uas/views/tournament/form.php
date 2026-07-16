<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php $is_edit = isset($tournament); ?>
<?php $errors = getFlashMessage('errors') ?? []; ?>
<?php $start_val = $is_edit ? $tournament['start_date'] : old('start_date'); ?>
<?php $end_val   = $is_edit ? $tournament['end_date']   : old('end_date'); ?>
<?php $slot_val  = $is_edit ? $tournament['max_teams']  : (old('max_teams') ?: 8); ?>
<?php $round_names = [4 => '2 Babak', 8 => '3 Babak', 16 => '4 Babak', 32 => '5 Babak']; ?>

<div class="max-w-xl fade-up form-compact">
    <div class="card card-accent">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <span class="header-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                </span>
                <div>
                    <h1 class="card-header-title"><?= $is_edit ? 'Edit Tournament' : 'Tambah Tournament' ?></h1>
                    <p class="card-header-desc"><?= $is_edit ? 'Ubah informasi turnamen' : 'Buat turnamen baru untuk memulai kompetisi' ?></p>
                </div>
            </div>
        </div>
        <div class="card-body">

            <?php if ($msg = getFlashMessage('error')): ?>
                <div class="alert alert-error"><?= e($msg) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= $is_edit ? "?page=tournament&action=update&id={$tournament['id']}" : '?page=tournament&action=store' ?>" id="tournament_form">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                <div class="form-group">
                    <label class="form-label">Nama Tournament <span class="required-star">*</span></label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                        </span>
                        <input type="text" name="name" value="<?= e($is_edit ? $tournament['name'] : old('name')) ?>"
                               class="form-input <?= isset($errors['name']) ? 'error' : '' ?>" placeholder="cth: Turnamen Mobile Legends" id="name_input" autofocus>
                    </div>
                    <?php if (isset($errors['name'])): ?><div class="form-error"><?= e($errors['name']) ?></div><?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-icon input-icon-top">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <textarea name="description" id="desc_input" class="form-textarea <?= isset($errors['description']) ? 'error' : '' ?>" placeholder="Deskripsi turnamen (opsional)" oninput="updateCharCount()"><?= e($is_edit ? $tournament['description'] : old('description')) ?></textarea>
                    </div>
                    <div class="field-hint"><span id="char_count">0</span>/500 karakter</div>
                </div>

                <div class="form-divider"></div>

                <div class="row-half">
                    <div class="col-half">
                        <label class="form-label">Tanggal Mulai <span class="required-star">*</span></label>
                        <div class="datepicker-wrap">
                            <input type="hidden" name="start_date" id="start_date" value="<?= e($start_val) ?>">
                            <div class="input-group">
                                <span class="input-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </span>
                                <input type="text" id="start_date_display" readonly autocomplete="off" data-target="start_date"
                                       value="<?= $start_val ? formatDate($start_val) : '' ?>"
                                       class="form-input datepicker-input <?= isset($errors['start_date']) ? 'error' : '' ?>" placeholder="Pilih tanggal">
                            </div>
                        </div>
                        <?php if (isset($errors['start_date'])): ?><div class="form-error"><?= e($errors['start_date']) ?></div><?php endif; ?>
                    </div>
                    <div class="col-half">
                        <label class="form-label">Tanggal Selesai <span class="required-star">*</span></label>
                        <div class="datepicker-wrap">
                            <input type="hidden" name="end_date" id="end_date" value="<?= e($end_val) ?>">
                            <div class="input-group">
                                <span class="input-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </span>
                                <input type="text" id="end_date_display" readonly autocomplete="off" data-target="end_date"
                                       value="<?= $end_val ? formatDate($end_val) : '' ?>"
                                       class="form-input datepicker-input <?= isset($errors['end_date']) ? 'error' : '' ?>" placeholder="Pilih tanggal">
                            </div>
                        </div>
                        <?php if (isset($errors['end_date'])): ?><div class="form-error"><?= e($errors['end_date']) ?></div><?php endif; ?>
                    </div>
                </div>
                <div id="duration_info" class="duration-info"></div>

                <div class="form-divider"></div>

                <div class="form-group">
                    <label class="form-label">Jumlah Tim (Slot Bracket)</label>
                    <div class="slot-grid" id="slot_grid">
                        <?php foreach ([4, 8, 16, 32] as $s): ?>
                        <button type="button" class="slot-option <?= $slot_val == $s ? 'active' : '' ?>" data-value="<?= $s ?>">
                            <span class="slot-num"><?= $s ?></span>
                            <span class="slot-label">Tim</span>
                            <span class="slot-rounds">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                                <?= $round_names[$s] ?>
                            </span>
                        </button>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="max_teams" id="max_teams" value="<?= $slot_val ?>">
                    <div id="slot_info" class="field-hint"></div>
                </div>

                <div class="action-row">
                    <button type="submit" class="btn btn-primary" id="btn_submit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span class="btn-text"><?= $is_edit ? 'Update' : 'Simpan' ?></span>
                        <span class="btn-spinner" style="display:none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><circle cx="12" cy="12" r="10" stroke-dasharray="32" stroke-dashoffset="32"/></svg>
                        </span>
                    </button>
                    <a href="?page=tournament" class="btn btn-secondary" id="btn_cancel">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    /* ===== Datepicker ===== */
    var dpInputs = document.querySelectorAll('.datepicker-input');
    if (dpInputs.length) {
        var popup = null;
        function closePopup() { if (popup) { popup.remove(); popup = null; } }
        function renderCal(input, y, m) {
            var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            var days = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
            var dim = new Date(y, m + 1, 0).getDate();
            var fd = new Date(y, m, 1).getDay();
            var today = new Date();
            var ts = today.getFullYear() + '-' + String(today.getMonth()+1).padStart(2,'0') + '-' + String(today.getDate()).padStart(2,'0');
            var he = document.getElementsByName(input.dataset.target)[0];
            var sv = he ? he.value : '';
            var h = '<div class="cal-header"><button type="button" class="cal-nav" data-y="'+y+'" data-m="'+(m-1)+'">&lsaquo;</button><span class="cal-title">'+months[m]+' '+y+'</span><button type="button" class="cal-nav" data-y="'+y+'" data-m="'+(m+1)+'">&rsaquo;</button></div>';
            h += '<table class="cal-table"><thead><tr>';
            for (var i = 0; i < 7; i++) h += '<th>'+days[i]+'</th>';
            h += '</tr></thead><tbody><tr>';
            for (var c = 0; c < fd; c++) h += '<td></td>';
            for (var d = 1; d <= dim; d++) {
                var ds = y + '-' + String(m+1).padStart(2,'0') + '-' + String(d).padStart(2,'0');
                var cls = 'cal-day';
                if (ds === ts) cls += ' cal-today';
                if (ds === sv) cls += ' cal-selected';
                h += '<td><button type="button" class="'+cls+'" data-date="'+ds+'">'+d+'</button></td>';
                if ((fd + d) % 7 === 0 && d < dim) h += '</tr><tr>';
            }
            h += '</tr></tbody></table>';
            return h;
        }
        function openCal(input) {
            closePopup();
            var he = document.getElementsByName(input.dataset.target)[0];
            var v = he ? he.value : '';
            var d = v ? new Date(v + 'T00:00:00') : new Date();
            popup = document.createElement('div');
            popup.className = 'cal-popup';
            popup.innerHTML = renderCal(input, d.getFullYear(), d.getMonth());
            document.body.appendChild(popup);
            var wrap = input.closest('.datepicker-wrap');
            var r = wrap.getBoundingClientRect();
            popup.style.top = (r.bottom + 4) + 'px';
            popup.style.left = r.left + 'px';
            if (r.width > 260) popup.style.minWidth = r.width + 'px';
            popup.addEventListener('click', function(e) {
                var btn = e.target.closest('.cal-nav');
                if (btn) { e.preventDefault(); var y = parseInt(btn.dataset.y), m = parseInt(btn.dataset.m); popup.innerHTML = renderCal(input, y, m); return; }
                var day = e.target.closest('.cal-day');
                if (day) {
                    e.preventDefault();
                    var ds = day.dataset.date;
                    var he = document.getElementsByName(input.dataset.target)[0];
                    if (he) he.value = ds;
                    var p = ds.split('-');
                    var mn = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    input.value = parseInt(p[2]) + ' ' + mn[parseInt(p[1])-1] + ' ' + p[0];
                    closePopup();
                    updateDuration();
                }
            });
        }
        dpInputs.forEach(function(inp) {
            inp.addEventListener('click', function() { openCal(this); });
        });
        document.addEventListener('click', function(e) {
            if (popup && !e.target.closest('.datepicker-wrap') && !e.target.closest('.cal-popup')) closePopup();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closePopup();
        });
    }

    /* ===== Slot Pills ===== */
    var slotGrid = document.getElementById('slot_grid');
    if (slotGrid) {
        var slotHidden = document.getElementById('max_teams');
        var slotInfo = document.getElementById('slot_info');
        var roundNames = {4: '2 Babak · 2 Pertandingan', 8: '3 Babak · 7 Pertandingan', 16: '4 Babak · 15 Pertandingan', 32: '5 Babak · 31 Pertandingan'};
        function updateSlotInfo() {
            var v = slotHidden.value;
            document.querySelectorAll('.slot-option').forEach(function(el) {
                el.classList.toggle('active', el.dataset.value == v);
            });
            slotInfo.textContent = roundNames[v] || '';
        }
        slotGrid.addEventListener('click', function(e) {
            var opt = e.target.closest('.slot-option');
            if (opt) { slotHidden.value = opt.dataset.value; updateSlotInfo(); }
        });
        updateSlotInfo();
    }

    /* ===== Duration Info ===== */
    function updateDuration() {
        var s = document.getElementById('start_date');
        var e = document.getElementById('end_date');
        var info = document.getElementById('duration_info');
        if (!s || !e || !info) return;
        if (s.value && e.value) {
            var d1 = new Date(s.value + 'T00:00:00');
            var d2 = new Date(e.value + 'T00:00:00');
            if (d2 >= d1) {
                var diff = Math.round((d2 - d1) / 86400000);
                info.textContent = '📅 Durasi ' + diff + ' hari' + (diff === 0 ? ' (hari yang sama)' : '');
                info.className = 'duration-info visible';
                return;
            }
        }
        info.className = 'duration-info';
        info.textContent = '';
    }

    /* Auto-fill end_date when start_date changes */
    var startHidden = document.getElementById('start_date');
    var endHidden = document.getElementById('end_date');
    if (startHidden && endHidden) {
        var origSet = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, 'value').set;
        [startHidden, endHidden].forEach(function(el) {
            Object.defineProperty(el, 'value', {
                set: function(v) { origSet.call(this, v); setTimeout(updateDuration, 0); },
                get: function() { return origSet ? undefined : ''; }
            });
        });
    }
    /* Poll as fallback */
    setInterval(updateDuration, 500);

    /* ===== Character Count ===== */
    window.updateCharCount = function() {
        var ta = document.getElementById('desc_input');
        var cc = document.getElementById('char_count');
        if (ta && cc) {
            var len = ta.value.length;
            cc.textContent = len;
            cc.style.color = len > 480 ? 'var(--destructive)' : 'inherit';
        }
    };
    setTimeout(updateCharCount, 100);

    /* ===== Prevent Double Submit ===== */
    document.getElementById('tournament_form').addEventListener('submit', function() {
        var btn = document.getElementById('btn_submit');
        btn.disabled = true;
        btn.classList.add('loading');
        btn.querySelector('.btn-text').textContent = 'Menyimpan...';
        btn.querySelector('.btn-spinner').style.display = 'inline';
    });

    /* ===== Unsaved Changes Warning ===== */
    var formChanged = false;
    document.getElementById('tournament_form').addEventListener('change', function() { formChanged = true; });
    document.getElementById('tournament_form').addEventListener('input', function() { formChanged = true; });
    document.getElementById('btn_cancel').addEventListener('click', function(e) {
        if (formChanged && !confirm('Ada perubahan yang belum disimpan. Yakin ingin meninggalkan halaman ini?')) {
            e.preventDefault();
        }
    });

})();
</script>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
