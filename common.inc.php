<?php
function printerr ($str, $verbosity=2) {
    file_put_contents('php://stderr', $str ."\n");
}
