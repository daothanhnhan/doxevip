<?php
    $q = $_GET['q'];
    $q = trim($q);
    $q = vi_en1($q);
    $_SESSION['search_productcat_id'] = '';
    if ($q == '') {
    	header('Location: /search-product/0');
    } else {
    	header('Location: /search-product/0/'.$q);
    }
    
?>