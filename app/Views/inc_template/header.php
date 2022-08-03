<!DOCTYPE html>
<html lang="en" class="overflow-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <style>
        .rotateIcon {
            transform: rotate(180deg);
            transition: 0.5s ease-in-out;
        }

        .iconSide {
            transform: rotate(90deg);
            transition: 0.5s ease-in-out;
        }
    </style>
    <?= $this->include('inc_template/v_script') ?>
</head>

<body>
    <div class="container-scroller">