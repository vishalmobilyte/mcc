<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message flasherror" onclick="this.classList.add('hidden');"><?= $message ?></div>
