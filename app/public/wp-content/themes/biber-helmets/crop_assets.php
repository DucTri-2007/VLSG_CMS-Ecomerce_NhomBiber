<?php
/**
 * Tự động trích xuất 10 ảnh bài viết từ Ảnh 1, 8 ảnh sản phẩm từ Ảnh 2, và Logo từ Ảnh 3
 */
function biker_extract_all_media_assets() {
    $brain_dir = 'C:/Users/DELL/.gemini/antigravity-ide/brain/5856ad80-eeba-4418-8864-3975bbbf4396/.user_uploaded/';
    $img_dir   = get_template_directory() . '/assets/images/';
    
    if (!is_dir($img_dir)) {
        @mkdir($img_dir, 0777, true);
    }

    // 1. Sao chép Logo (Ảnh 3)
    $logo_src = file_exists($brain_dir . 'media_1789593552551.png') ? $brain_dir . 'media_1789593552551.png' : $img_dir . 'biker-logo.png';
    $logo_dst = $img_dir . 'biker-logo.png';
    if (file_exists($logo_src) && $logo_src !== $logo_dst && (!file_exists($logo_dst) || filesize($logo_dst) < 1000)) {
        @copy($logo_src, $logo_dst);
    }

    // 2. Cắt 10 ảnh bài viết từ Ảnh 1 (media_1789593307046.jpg)
    $news_src = file_exists($brain_dir . 'media_1789593307046.jpg') ? $brain_dir . 'media_1789593307046.jpg' : $img_dir . 'news-grid-full.jpg';
    if (file_exists($news_src) && function_exists('imagecreatefromjpeg') && !file_exists($img_dir . 'news-10.jpg')) {
        $src_img = @imagecreatefromjpeg($news_src);
        if ($src_img) {
            $w = imagesx($src_img);
            $h = imagesy($src_img);
            if (!file_exists($img_dir . 'news-grid-full.jpg') && $news_src !== $img_dir . 'news-grid-full.jpg') {
                @copy($news_src, $img_dir . 'news-grid-full.jpg');
            }

            $boxes = array(
                1  => array((int)($w * 0.16), (int)($h * 0.02), (int)($w * 0.16), (int)($h * 0.33)),
                2  => array((int)($w * 0.33), (int)($h * 0.02), (int)($w * 0.16), (int)($h * 0.26)),
                3  => array((int)($w * 0.50), (int)($h * 0.02), (int)($w * 0.16), (int)($h * 0.40)),
                4  => array((int)($w * 0.67), (int)($h * 0.02), (int)($w * 0.16), (int)($h * 0.26)),
                5  => array((int)($w * 0.84), (int)($h * 0.02), (int)($w * 0.15), (int)($h * 0.28)),
                6  => array((int)($w * 0.33), (int)($h * 0.30), (int)($w * 0.16), (int)($h * 0.22)),
                7  => array((int)($w * 0.16), (int)($h * 0.45), (int)($w * 0.16), (int)($h * 0.21)),
                8  => array((int)($w * 0.33), (int)($h * 0.53), (int)($w * 0.16), (int)($h * 0.32)),
                9  => array((int)($w * 0.84), (int)($h * 0.32), (int)($w * 0.15), (int)($h * 0.24)),
                10 => array((int)($w * 0.67), (int)($h * 0.65), (int)($w * 0.16), (int)($h * 0.30)),
            );

            foreach ($boxes as $i => $b) {
                $crop = @imagecreatetruecolor($b[2], $b[3]);
                if ($crop) {
                    @imagecopy($crop, $src_img, 0, 0, $b[0], $b[1], $b[2], $b[3]);
                    @imagejpeg($crop, $img_dir . "news-{$i}.jpg", 90);
                    @imagedestroy($crop);
                }
            }
            @imagedestroy($src_img);
        }
    }

    // 3. Cắt 8 ảnh mũ bảo hiểm từ Ảnh 2 (media_1789593488232.png)
    $helmets_src = file_exists($brain_dir . 'media_1789593488232.png') ? $brain_dir . 'media_1789593488232.png' : $img_dir . 'helmets-grid-full.png';
    if (file_exists($helmets_src) && function_exists('imagecreatefrompng') && !file_exists($img_dir . 'helmet-8.jpg')) {
        $src_img = @imagecreatefrompng($helmets_src);
        if ($src_img) {
            $w = imagesx($src_img);
            $h = imagesy($src_img);
            if (!file_exists($img_dir . 'helmets-grid-full.png') && $helmets_src !== $img_dir . 'helmets-grid-full.png') {
                @copy($helmets_src, $img_dir . 'helmets-grid-full.png');
            }

            $boxes2 = array(
                1 => array((int)($w * 0.70), (int)($h * 0.10), (int)($w * 0.14), (int)($h * 0.33)),
                2 => array((int)($w * 0.27), (int)($h * 0.11), (int)($w * 0.14), (int)($h * 0.34)),
                3 => array((int)($w * 0.41), (int)($h * 0.00), (int)($w * 0.14), (int)($h * 0.27)),
                4 => array((int)($w * 0.27), (int)($h * 0.49), (int)($w * 0.14), (int)($h * 0.29)),
                5 => array((int)($w * 0.56), (int)($h * 0.53), (int)($w * 0.14), (int)($h * 0.31)),
                6 => array((int)($w * 0.12), (int)($h * 0.21), (int)($w * 0.14), (int)($h * 0.25)),
                7 => array((int)($w * 0.41), (int)($h * 0.58), (int)($w * 0.14), (int)($h * 0.27)),
                8 => array((int)($w * 0.70), (int)($h * 0.52), (int)($w * 0.14), (int)($h * 0.30)),
            );

            foreach ($boxes2 as $i => $b) {
                $crop = @imagecreatetruecolor($b[2], $b[3]);
                if ($crop) {
                    @imagecopy($crop, $src_img, 0, 0, $b[0], $b[1], $b[2], $b[3]);
                    @imagejpeg($crop, $img_dir . "helmet-{$i}.jpg", 90);
                    @imagedestroy($crop);
                }
            }
            @imagedestroy($src_img);
        }
    }
}
