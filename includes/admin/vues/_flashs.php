<?php if (!empty($flashs)): ?>
    <div class="flashs">
        <?php foreach ($flashs as $f): ?>
            <div class="flash <?= e($f['type']) ?>"><?= $f['type'] === 'succes' ? '✔' : '⚠' ?> <span><?= $f['message'] ?></span></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
