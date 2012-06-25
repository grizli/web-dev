<?php
function hex2binMy($str) {
    $bin = "";
    $i = 0;
    do {
        $bin .= chr(hexdec($str{$i}.$str{($i + 1)}));
        $i += 2;
    } while ($i < strlen($str));
    return $bin;
}


function bin2hexMy($str) {
    $hex = "";
    $i = 0;
    do {
        $hex .= dechex(ord($str{$i}));
        $i++;
    } while ($i < strlen($str));
    return $hex;
}
?>
