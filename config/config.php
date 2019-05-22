<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "1234");
define("DB_NAME", "phpadvancedb");
define("DB_PORT", "3306");
define("DB_ENCODING", "utf8");

/*
|--------------------------------------------------------------------------
| UPLOAD IMAGE WITH ORIGINAL
|--------------------------------------------------------------------------
|
| ฟังก์ชันอัพโหลดรูปภาพโดยเก็บภาพต้นฉบับไว้ด้วย
|
*/

function genius_uploadimg(
    $inputname = "files",
    $filename = "nofilename.jpg",
    $filesize,
    $filetmp,
    $filetype,
    $maxfilesize = "2000000",
    $orgdirectory = "uploadphotos",
    $thumbdirectory = "thumbphotos",
    $thumbwidth = "100",
    $thumbheight = "100"
) {
    if (isset($_FILES[$inputname])) {

        $errors = array();

        $file_name = $filename;
        $file_size = $filesize;
        $file_tmp = $filetmp;
        $file_type = $filetype;

        if ($file_size > $maxfilesize) {
            $errors[] = "File size must be less than " . ($maxfilesize / 2000000) . " MB";
        }

        if (empty($errors) == true) {

            if (is_dir($orgdirectory) == false) {
                mkdir("$orgdirectory", 0700);
            }

            if (is_dir($thumbdirectory) == false) {
                mkdir("$thumbdirectory", 0700);
            }

            if (is_dir("$orgdirectory/" . $file_name) == false) {
                $max_width = $thumbwidth;
                $max_height = $thumbheight;
                $thumbname = $thumbdirectory . "/" . $file_name;

                if ($file_type == 'image/jpeg') {
                    $src = imagecreatefromjpeg($file_tmp);
                } else if ($file_type == 'image/png') {
                    $src = imagecreatefrompng($file_tmp);
                } else if ($file_type == 'image/gif') {
                    $src = imagecreatefromgif($file_tmp);
                }

                list($width, $height) = getimagesize($file_tmp);

                $tmp = imagecreatetruecolor($max_width, $max_height);

                $width_new = $height * $max_width / $max_height;
                $height_new = $width * $max_height / $max_width;

                if ($width_new > $width) {
                    $h_point = (($height - $height_new) / 2);

                    if ($file_type == 'image/png') {
                        imagealphablending($tmp, false);
                        imagesavealpha($tmp, true);
                        $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
                        imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
                    }

                    imagecopyresampled($tmp, $src, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
                } else {
                    $w_point = (($width - $width_new) / 2);

                    if ($file_type == 'image/png') {
                        imagealphablending($tmp, false);
                        imagesavealpha($tmp, true);
                        $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
                        imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
                    }

                    imagecopyresampled($tmp, $src, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
                }

                if ($file_type == 'image/jpeg') {
                    imagejpeg($tmp, $thumbname, 100);
                } else if ($file_type == 'image/png') {
                    imagepng($tmp, $thumbname);
                } else if ($file_type == 'image/gif') {
                    imagegif($tmp, $thumbname, 100);
                }

                imagedestroy($src);
                move_uploaded_file($file_tmp, "$orgdirectory/" . $file_name);
            } else {
                $new_dir = "$orgdirectory/" . $file_name . time();
                rename($file_tmp, $new_dir);
            }
        } else {
            echo "<pre>";
            print_r($errors);
            echo "</pre>";
            die();
        }

        if (empty($errors)) {
            return true;
        } else {
            echo "<pre>";
            print_r($errors);
            echo "</pre>";
            die();
        }
    }
}
