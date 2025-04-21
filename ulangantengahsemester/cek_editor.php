<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] !== 'editor'){
    echo "akses ditolak. halaman ini hanya untuk editor";
    exit;
}
?>