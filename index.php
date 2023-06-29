<?php

// sudo apt-get install php-gd install this first

// Путь к исходному изображению
$imagePathPng = 'МСК-РБ-106 Игровой комплпекс Символ.png';
$imagePathJpg = 'ЛГВО-22 01.jpg';

// Загрузка исходного изображения
$imagePng = imagecreatefrompng($imagePathPng);
imagesavealpha($imagePng, true);
$transparent = imagecolorallocatealpha($imagePng, 0, 0, 0, 127);
imagefill($imagePng, 0, 0, $transparent);

$imageJpg = imagecreatefromjpeg($imagePathJpg);

// Путь к файлу водяного знака
$watermarkPath = '2016-LeberGroup_Logo-element.png';

// Загрузка водяного знака
$watermark = imagecreatefrompng($watermarkPath);

// Получение размеров исходного изображения
$imageWidthPng = imagesx($imagePng);
$imageHeightPng = imagesy($imagePng);

$imageWidthJpg = imagesx($imageJpg);
$imageHeightJpg = imagesy($imageJpg);

// Получение размеров водяного знака
$watermarkWidth = imagesx($watermark);
$watermarkHeight = imagesy($watermark);

// Расчет позиции водяного знака
$positionXPng = ($imageWidthPng - $watermarkWidth) / 2;
$positionYPng = ($imageHeightPng - $watermarkHeight) / 2;

$positionXJpg = ($imageWidthJpg - $watermarkWidth) / 2;
$positionYJpg = ($imageHeightJpg - $watermarkHeight) / 2;

// Наложение водяного знака на исходное изображение
imagecopy($imagePng, $watermark, $positionXPng, $positionYPng, 0, 0, $watermarkWidth, $watermarkHeight);

imagecopy($imageJpg, $watermark, $positionXJpg, $positionYJpg, 0, 0, $watermarkWidth, $watermarkHeight);

// Сохранение измененного изображения
imagepng($imagePng, 'output.png');

imagepng($imageJpg, 'output.jpg');

echo "Watermark added successfully to PNG and JPG image!";

?>
