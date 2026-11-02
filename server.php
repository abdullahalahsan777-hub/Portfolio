<?php
/**
 * Portfolio — Multi-Theme Developer & Designer
 * Complete multi-theme portfolio with admin panel to maintain everything.
 *
 * @package  Portfolio
 * @author   Md. Abdullah Al Ahsan <[EMAIL_ADDRESS]>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
