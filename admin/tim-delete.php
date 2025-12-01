<?php
include '../includes/header-admin.php';
include_once '../includes/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id){
    $q = mysqli_query($conn, "SELECT * FROM tim WHERE id=". $id);
    $r = mysqli_fetch_assoc($q);
    if($r){
        // remove uploaded foto if in upload/
        if(!empty($r['foto']) && strpos($r['foto'], 'upload/') === 0 && file_exists('../' . $r['foto'])){
            @unlink('../' . $r['foto']);
        }
        mysqli_query($conn, "DELETE FROM tim WHERE id=". $id);
    }
}
header('Location: tim-index.php'); exit;
