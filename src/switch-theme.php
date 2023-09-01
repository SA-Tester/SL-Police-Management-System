<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //toggles the theme
    $_SESSION['dark'] = !$_SESSION['dark'];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}