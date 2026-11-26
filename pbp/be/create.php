<?php 
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'msg' => 'Method Salah !'
    ]);
    exit;
}

$errors = [];

if (!isset($_POST['kode'])) {
    $errors['kode'] = "kode tidak di kirim";
} else {
    if ($_POST['kode'] == '') { //jika kode kosong
        $errors['kode'] = "kode tidak boleh kosong";
    }else{ //jika kode tidak kosong
        if(!preg_match('/^\d{4,}$/', $_POST['kode'])){
            $errors['kode'] = "kode harus berupa angka dan minimal 4 digit";
        }
    }
}

if (count($errors) > 0) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'msg' => 'Data tidak valid',
        'errors' => $errors
    ]);
    exit();
}



echo json_encode([
    'status' => 'success',
    'data' => [
        'kode' => $_POST['kode'],
    ]
], JSON_PRETTY_PRINT);