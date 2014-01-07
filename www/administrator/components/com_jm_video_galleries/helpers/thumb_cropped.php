<?php
/**
 * @package     com_jm_video_galleries
 * @version     1.0.0
 * Author - JoomlaMan http://www.joomlaman.com
 * Copyright (C) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * Websites: http://www.JoomlaMan.com
 * Support: support@joomlaman.com
*/
function create_cropped_thumbnail($image_path, $thumb_width, $thumb_height, $prefix) {
    if (!(is_integer($thumb_width) && $thumb_width > 0) && !($thumb_width === "*")) {
        echo "The width is invalid";
        exit(1);
    }
    if (!(is_integer($thumb_height) && $thumb_height > 0) && !($thumb_height === "*")) {
        echo "The height is invalid";
        exit(1);
    }
    $extension = pathinfo($image_path, PATHINFO_EXTENSION);
    switch ($extension) {
        case "jpg":
        case "jpeg":
            $source_image = imagecreatefromjpeg($image_path);
            break;
        case "gif":
            $source_image = imagecreatefromgif($image_path);
            break;
        case "png":
            $source_image = imagecreatefrompng($image_path);
            break;
        default:
            exit(1);
            break;
    }
    $source_width = imageSX($source_image);
    $source_height = imageSY($source_image);
    if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
        $source_x = 0;
        $source_y = 0;
    }
    if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
        $source_y = 0;
        $temp_width = $source_height * $thumb_width / $thumb_height;
        $source_x = ($source_width - $temp_width) / 2;
        $source_width = $temp_width;
    }
    if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
        $source_x = 0;
        $temp_height = $source_width * $thumb_height / $thumb_width;
        $source_y = ($source_height - $temp_height) / 2;
        $source_height = $temp_height;
    }
    $target_image = ImageCreateTrueColor($thumb_width, $thumb_height);
    imagecopyresampled($target_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height, $source_width, $source_height);
    switch ($extension) {
        case "jpg":
        case "jpeg":
            imagejpeg($target_image, $prefix . "_" . $image_path);
            break;
        case "gif":
            imagegif($target_image, $prefix . "_" . $image_path);
            break;
        case "png":
            imagepng($target_image, $prefix . "_" . $image_path);
            break;
        default:
            exit(1);
            break;
    }
    imagedestroy($target_image);
    imagedestroy($source_image);
}
?>
