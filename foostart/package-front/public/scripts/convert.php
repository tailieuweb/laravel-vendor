<?php

//load file config
$config = require_once (realpath(__DIR__.'../../../config/package-front.php'));

//load LESS library
require_once './lessc.inc.php';

$less = 'less';
$css = 'css';


//define list of using assets
$block_ids = $config['block_ids'];

//build LESS to CSS
$assets_path = realpath(__DIR__.'../../');

//LESS
foreach ($block_ids as $id) {


    $source = realpath($assets_path . '/' . $less . '/blocks/' . $id . '.less');
    $target = $assets_path . '/' . $css . '/blocks/' . $id . '.css';

    if (!empty($source)) {
        $obj_less = new lessc();
        $obj_less->compileFile($source, $target);
    }

}

?>
Done