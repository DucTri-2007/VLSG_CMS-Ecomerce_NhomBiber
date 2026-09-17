<?php
$src = "C:/Users/DELL/.gemini/antigravity-ide/brain/3ae9ec23-4f9f-49c9-b9dc-fb22bdbd873d/.user_uploaded/media_1789549164588.png";
$dest1 = "e:/biker so 1/team biker/avatar.png";
$dest2 = __DIR__ . "/avatar.png";

$copied1 = copy($src, $dest1);
$copied2 = copy($src, $dest2);

$data = file_get_contents($src);
$base64 = base64_encode($data);
file_put_contents("e:/biker so 1/team biker/avatar_base64.txt", $base64);

echo "Copied to dest1: " . ($copied1 ? "YES" : "NO") . "\n";
echo "Copied to dest2: " . ($copied2 ? "YES" : "NO") . "\n";
echo "Base64 length: " . strlen($base64) . "\n";
?>
