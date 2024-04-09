<? if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/css/' . basename($_SERVER['PHP_SELF'], ".php") . ".css")) { ?>
    <link href="/app/css/<?= basename($_SERVER['PHP_SELF'], ".php") ?>.css" rel="stylesheet">
<? } ?>