<?php
if (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled') {
    setcookie('darkMode', 'disabled', time() - 3600, '/');
} else {
    setcookie('darkMode', 'enabled', time() + (86400 * 30), '/');
}
