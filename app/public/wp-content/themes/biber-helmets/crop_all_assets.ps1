Add-Type -AssemblyName System.Drawing

$imgDir = "e:\biker so 1\team biker\app\public\wp-content\themes\biber-helmets\assets\images"
$newsSrc = Join-Path $imgDir "news-grid-full.jpg"
$helmSrc = Join-Path $imgDir "helmets-grid-full.png"

# 1. Cắt 10 ảnh bài viết an toàn từ Ảnh 1
if (Test-Path $newsSrc) {
    try {
        $img = [System.Drawing.Bitmap]::FromFile($newsSrc)
        $w = $img.Width
        $h = $img.Height
        Write-Host "News image loaded: $w x $h"

        $boxes = @{
            1  = @([int]($w * 0.16), [int]($h * 0.02), [int]($w * 0.16), [int]($h * 0.33))
            2  = @([int]($w * 0.33), [int]($h * 0.02), [int]($w * 0.16), [int]($h * 0.26))
            3  = @([int]($w * 0.50), [int]($h * 0.02), [int]($w * 0.16), [int]($h * 0.40))
            4  = @([int]($w * 0.67), [int]($h * 0.02), [int]($w * 0.16), [int]($h * 0.26))
            5  = @([int]($w * 0.84), [int]($h * 0.02), [int]($w * 0.15), [int]($h * 0.28))
            6  = @([int]($w * 0.33), [int]($h * 0.30), [int]($w * 0.16), [int]($h * 0.22))
            7  = @([int]($w * 0.16), [int]($h * 0.45), [int]($w * 0.16), [int]($h * 0.21))
            8  = @([int]($w * 0.33), [int]($h * 0.53), [int]($w * 0.16), [int]($h * 0.32))
            9  = @([int]($w * 0.84), [int]($h * 0.32), [int]($w * 0.15), [int]($h * 0.24))
            10 = @([int]($w * 0.67), [int]($h * 0.65), [int]($w * 0.16), [int]($h * 0.30))
        }

        foreach ($key in $boxes.Keys | Sort-Object) {
            $b = $boxes[$key]
            $rect = New-Object System.Drawing.Rectangle $b[0], $b[1], $b[2], $b[3]
            $crop = $img.Clone($rect, $img.PixelFormat)
            $dest = Join-Path $imgDir "news-$key.jpg"
            $crop.Save($dest, [System.Drawing.Imaging.ImageFormat]::Jpeg)
            $crop.Dispose()
            Write-Host "Saved news-$key.jpg"
        }
        $img.Dispose()
    } catch {
        Write-Host "Error cropping news: $_"
    }
}

# 2. Cắt 8 ảnh mũ bảo hiểm từ Ảnh 2
if (Test-Path $helmSrc) {
    try {
        $img2 = [System.Drawing.Bitmap]::FromFile($helmSrc)
        $w2 = $img2.Width
        $h2 = $img2.Height
        Write-Host "Helmets image loaded: $w2 x $h2"

        $boxes2 = @{
            1 = @([int]($w2 * 0.70), [int]($h2 * 0.10), [int]($w2 * 0.14), [int]($h2 * 0.33))
            2 = @([int]($w2 * 0.27), [int]($h2 * 0.11), [int]($w2 * 0.14), [int]($h2 * 0.34))
            3 = @([int]($w2 * 0.41), [int]($h2 * 0.00), [int]($w2 * 0.14), [int]($h2 * 0.27))
            4 = @([int]($w2 * 0.27), [int]($h2 * 0.49), [int]($w2 * 0.14), [int]($h2 * 0.29))
            5 = @([int]($w2 * 0.56), [int]($h2 * 0.53), [int]($w2 * 0.14), [int]($h2 * 0.31))
            6 = @([int]($w2 * 0.12), [int]($h2 * 0.21), [int]($w2 * 0.14), [int]($h2 * 0.25))
            7 = @([int]($w2 * 0.41), [int]($h2 * 0.58), [int]($w2 * 0.14), [int]($h2 * 0.27))
            8 = @([int]($w2 * 0.70), [int]($h2 * 0.52), [int]($w2 * 0.14), [int]($h2 * 0.30))
        }

        foreach ($key2 in $boxes2.Keys | Sort-Object) {
            $b2 = $boxes2[$key2]
            $rect2 = New-Object System.Drawing.Rectangle $b2[0], $b2[1], $b2[2], $b2[3]
            $crop2 = $img2.Clone($rect2, $img2.PixelFormat)
            $dest2 = Join-Path $imgDir "helmet-$key2.jpg"
            $crop2.Save($dest2, [System.Drawing.Imaging.ImageFormat]::Jpeg)
            $crop2.Dispose()
            Write-Host "Saved helmet-$key2.jpg"
        }
        $img2.Dispose()
    } catch {
        Write-Host "Error cropping helmets: $_"
    }
}

Write-Host "ALL ASSETS CROPPED SUCCESSFULLY!"
