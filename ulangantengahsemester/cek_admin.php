<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin'){
    echo "akses ditolak. halaman ini hanya untuk admin";
    exit;
}
?>