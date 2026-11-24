Add-Type -AssemblyName System.Drawing

$srcPath = "C:\Users\hp\.gemini\antigravity\brain\aa8ba0c8-7d9c-49f9-a279-f912f97e4825\.user_uploaded\media_1795501212364_91aba854.jpg"
$outPath = "C:\arunachal_gas\public\images\hero-figma.png"
$logoPath = "C:\arunachal_gas\public\images\agpl-logo.png"

$srcImg = [System.Drawing.Image]::FromFile($srcPath)
Write-Output "Image size: $($srcImg.Width) x $($srcImg.Height)"

# Crop Hero Banner
# The image is 750 width approx or let's see. The hero card occupies roughly x=30 to x=720, y=100 to y=450
$x = [int]($srcImg.Width * 0.04)
$y = [int]($srcImg.Height * 0.21)
$w = [int]($srcImg.Width * 0.92)
$h = [int]($srcImg.Height * 0.72)

$rect = New-Object System.Drawing.Rectangle($x, $y, $w, $h)
$bmp = New-Object System.Drawing.Bitmap($w, $h)
$g = [System.Drawing.Graphics]::FromImage($bmp)
$g.DrawImage($srcImg, 0, 0, $rect, [System.Drawing.GraphicsUnit]::Pixel)
$g.Dispose()

$bmp.Save($outPath, [System.Drawing.Imaging.ImageFormat]::Png)
$bmp.Dispose()

# Crop Header Logo
$lx = [int]($srcImg.Width * 0.04)
$ly = [int]($srcImg.Height * 0.005)
$lw = [int]($srcImg.Width * 0.28)
$lh = [int]($srcImg.Height * 0.10)

$lrect = New-Object System.Drawing.Rectangle($lx, $ly, $lw, $lh)
$lbmp = New-Object System.Drawing.Bitmap($lw, $lh)
$lg = [System.Drawing.Graphics]::FromImage($lbmp)
$lg.DrawImage($srcImg, 0, 0, $lrect, [System.Drawing.GraphicsUnit]::Pixel)
$lg.Dispose()

$lbmp.Save($logoPath, [System.Drawing.Imaging.ImageFormat]::Png)
$lbmp.Dispose()

$srcImg.Dispose()
Write-Output "Successfully saved cropped assets to $outPath and $logoPath"
