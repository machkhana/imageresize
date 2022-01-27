<?php

class Image{
    /**
     * Image re-size
     * @param int $width
     * @param int $height
     */
    function ImageResize($width, $height, $file)
    {
        $dir = 'uploads/'; //directory whe need to upload
        /* Get original file size */
        list($w, $h) = getimagesize($_FILES['file']['tmp_name']);
        /* Calculate new image size */
        $ratio = max($width/$w, $height/$h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);
        /* set new file name */
        $path = date('Ymdhmi').'-'.$file;
        /* Save image */
        if($_FILES['file']['type']=='image/jpeg')
        {
            /* Get binary data from image */
            $imgString = file_get_contents($_FILES['file']['tmp_name']);
            /* create image from string */
            $image = imagecreatefromstring($imgString);
            $tmp = imagecreatetruecolor($width, $height);
            imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
            imagejpeg($tmp, $dir.$path, 100);
        }
        else if($_FILES['file']['type']=='image/png')
        {
            $image = imagecreatefrompng($_FILES['file']['tmp_name']);
            $tmp = imagecreatetruecolor($width,$height);
            imagealphablending($tmp, false);
            imagesavealpha($tmp, true);
            imagecopyresampled($tmp, $image,0,0,$x,0,$width,$height,$w, $h);
            imagepng($tmp, $dir.$path, 0);
        }
        else if($_FILES['file']['type']=='image/gif')
        {
            $image = imagecreatefromgif($_FILES['file']['tmp_name']);
            $tmp = imagecreatetruecolor($width,$height);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $transparent);
            imagealphablending($tmp, true);
            imagecopyresampled($tmp, $dir.$image,0,0,0,0,$width,$height,$w, $h);
            imagegif($tmp, $path);
        }
        else
        {
            return false;
        }
            return true;
        imagedestroy($image);
        imagedestroy($tmp);
    }
}
$image = new Image();
