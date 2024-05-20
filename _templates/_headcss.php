<? if (file_exists($_SERVER['DOCUMENT_ROOT'] . get_config('base_path').'css/' . basename($_SERVER['PHP_SELF'], ".php") . ".css")) { ?>
    <link href="<?=get_config('base_path')?>css/<?= basename($_SERVER['PHP_SELF'], ".php") ?>.css" rel="stylesheet">
<? } ?>