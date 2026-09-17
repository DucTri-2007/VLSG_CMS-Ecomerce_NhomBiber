@echo off
chcp 65001 >nul
title Dong Bo Biker Helmets Len Pantheon Biker-T5
cls
echo ================================================================
echo  DANG DONG BO TOAN BO CODE MOI LEN PANTHEON BIKER-T5...
echo ================================================================
echo.

set HOST=appserver.dev.f96d3db1-2fa7-4dd3-9be5-aa58623d7b3a.drush.in
set USER=dev.f96d3db1-2fa7-4dd3-9be5-aa58623d7b3a
set PORT=2222
set LOCAL_THEME=e:\biker so 1\team biker\app\public\wp-content\themes\biber-helmets
set BRAIN_UPLOADED=C:\Users\DELL\.gemini\antigravity-ide\brain\5856ad80-eeba-4418-8864-3975bbbf4396\.user_uploaded

echo [1/5] Sao chep toan bo anh goc vao assets/images...
if exist "%BRAIN_UPLOADED%\media_1789593552551.png" copy /y "%BRAIN_UPLOADED%\media_1789593552551.png" "%LOCAL_THEME%\assets\images\biker-logo.png" >nul
if exist "%BRAIN_UPLOADED%\media_1789593307046.jpg" copy /y "%BRAIN_UPLOADED%\media_1789593307046.jpg" "%LOCAL_THEME%\assets\images\news-grid-full.jpg" >nul
if exist "%BRAIN_UPLOADED%\media_1789593488232.png" copy /y "%BRAIN_UPLOADED%\media_1789593488232.png" "%LOCAL_THEME%\assets\images\helmets-grid-full.png" >nul
if exist "%BRAIN_UPLOADED%\media_1789596187520.png" copy /y "%BRAIN_UPLOADED%\media_1789596187520.png" "%LOCAL_THEME%\assets\images\helmets-grid-extra1.png" >nul
if exist "%BRAIN_UPLOADED%\media_1789596217347.png" copy /y "%BRAIN_UPLOADED%\media_1789596217347.png" "%LOCAL_THEME%\assets\images\helmets-grid-extra2.png" >nul

echo [2/5] Cat anh bai viet va mu bao hiem...
powershell -NoProfile -ExecutionPolicy Bypass -File "%LOCAL_THEME%\crop_all_assets.ps1"

echo [3/5] Dong goi file ZIP theme (biber-helmets-moi-nhat.zip)...
python "e:\biker so 1\team biker\make_zip.py"

echo [4/5] Tu dong copy SSH Key vao Clipboard...
if exist "%USERPROFILE%\.ssh\id_rsa.pub" (
    type "%USERPROFILE%\.ssh\id_rsa.pub" | clip
    echo    - Da copy id_rsa.pub vao bo nho tam (Clipboard)
) else if exist "%USERPROFILE%\.ssh\id_ed25519.pub" (
    type "%USERPROFILE%\.ssh\id_ed25519.pub" | clip
    echo    - Da copy id_ed25519.pub vao bo nho tam (Clipboard)
)

echo.
echo [5/5] Dang upload len server Pantheon qua SFTP Native...
sftp -o Port=%PORT% -i "%USERPROFILE%\.ssh\id_rsa" -o StrictHostKeyChecking=no -b "e:\biker so 1\team biker\sftp_batch.txt" %USER%@%HOST%

if %errorlevel% neq 0 (
    echo.
    echo [THU LAI] Dang thu ket noi bang id_ed25519...
    sftp -o Port=%PORT% -i "%USERPROFILE%\.ssh\id_ed25519" -o StrictHostKeyChecking=no -b "e:\biker so 1\team biker\sftp_batch.txt" %USER%@%HOST%
)

if %errorlevel% neq 0 (
    echo.
    echo [THU LAI] Dang thu ket noi qua SCP fallback...
    scp -P %PORT% -i "%USERPROFILE%\.ssh\id_rsa" -o StrictHostKeyChecking=no "%LOCAL_THEME%\functions.php" %USER%@%HOST%:code/wp-content/themes/biber-helmets/functions.php
    scp -P %PORT% -i "%USERPROFILE%\.ssh\id_rsa" -o StrictHostKeyChecking=no "%LOCAL_THEME%\footer.php" %USER%@%HOST%:code/wp-content/themes/biber-helmets/footer.php
    scp -P %PORT% -i "%USERPROFILE%\.ssh\id_rsa" -o StrictHostKeyChecking=no "%LOCAL_THEME%\front-page.php" %USER%@%HOST%:code/wp-content/themes/biber-helmets/front-page.php
    scp -P %PORT% -i "%USERPROFILE%\.ssh\id_rsa" -o StrictHostKeyChecking=no "%LOCAL_THEME%\page-tin-tuc.php" %USER%@%HOST%:code/wp-content/themes/biber-helmets/page-tin-tuc.php
)

echo.
echo ================================================================
echo  NEU TERMINAL CO DONG CHU "Permission denied (publickey)":
echo  Ly do: Pantheon chua luu SSH Key cua ban nen may chu chan upload.
echo.
echo  CACH KHAC PHUC NHANH NHAT VA CHAC CHAN 100%%:
echo  1. Vao trang quan tri WordPress Pantheon:
echo     https://dev-biker-t5.pantheonsite.io/wp-admin/
echo  2. Vao menu ben trai: Giao dien (Appearance) ^> Them moi (Add New Theme) ^> Tai giao dien len (Upload Theme)
echo  3. Chon file vua tao: e:\biker so 1\team biker\biber-helmets-moi-nhat.zip
echo  4. Bam "Cai dat ngay" ^> Chon "Thay the bang giao dien tai len"
echo.
echo  =^> Web se co ngay lap tuc: 10 Bai Viet, 21 San Pham & Chatbot AI!
echo ================================================================
echo.
pause
