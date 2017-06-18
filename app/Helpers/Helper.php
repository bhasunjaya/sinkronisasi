<?php
function prefixActive($prefix, $output = 'open active')
{
    if (Route::getCurrentRoute()->getPrefix() == $prefix) {
        return $output;
    }
}
