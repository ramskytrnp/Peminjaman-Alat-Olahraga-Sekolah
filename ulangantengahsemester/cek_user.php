<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] !== 'user'){
    echo "akses ditolak. halaman ini hanya untuk user";
    exit;
}
?>