<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $data['title']; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <link rel="stylesheet" href="<?= PATH_CSS . '/reset.css'; ?>">
        <link rel="stylesheet" href="<?= PATH_CSS . '/style.css'; ?>">
        <link rel="stylesheet" href="<?= PATH_CSS . '/bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?= PATH_CSS . '/bootstrap-theme.min.css'; ?>">
        
        <!-- JS -->
        <script type="text/javascript" src="<?= PATH_JS . '/jquery.min.js'; ?>"></script>
        <script type="text/javascript" src="<?= PATH_JS . '/jquery-ui.min.js'; ?>"></script>
        <script type="text/javascript" src="<?= PATH_JS . '/jquery.validate.min.js'; ?>"></script>
        <script type="text/javascript" src="<?= PATH_JS . '/bootstrap.min.js'; ?>"></script>
        <script type="text/javascript" src="<?= PATH_JS . '/application.js'; ?>"></script>
    </head>

    <body>
        <?php require_once PATH_VIEWS . '_templates/menu.php'; ?>
        <div class="clearfix"></div>
        
        <div class="container">
        <!-- exibe o feedback do sistema (mensagens de erros e sucesso) -->
        <?php //$this->renderFeedbackMessages(); ?>