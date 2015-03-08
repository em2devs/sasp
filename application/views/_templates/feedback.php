<?php

// retorna as mensagens de feedback (arrays sao utilzados para tornar possivel
// retornar multiplas mensagens de positivo/negativo
$feedback_positive = \Lib\Session::get('feedback_positive');
$feedback_negative = \Lib\Session::get('feedback_negative');

// exibe mensagens positivas existentes
if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback) {
        echo '<div class="feedback success">'.$feedback.'</div>';
    }
}

// exibe mensagens negativas existentes
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback) {
        echo '<div class="feedback error">'.$feedback.'</div>';
    }
}
