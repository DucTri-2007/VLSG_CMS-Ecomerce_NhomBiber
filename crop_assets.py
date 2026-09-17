import os
from PIL import Image

brain_dir = r"C:\Users\DELL\.gemini\antigravity-ide\brain\5856ad80-eeba-4418-8864-3975bbbf4396\.user_uploaded"
out_dir = r"e:\biker so 1\team biker\app\public\wp-content\themes\biber-helmets\assets\images"
os.makedirs(out_dir, exist_ok=True)

# 1. Copy Logo
logo_src = os.path.join(brain_dir, "media_1789593552551.png")
if os.path.exists(logo_src):
    img_logo = Image.open(logo_src)
    img_logo.save(os.path.join(out_dir, "biker-logo.png"))
    print("Saved biker-logo.png")

# 2. Crop Image 1 (News / Accident Safety Articles)
img1_src = os.path.join(brain_dir, "media_1789593307046.jpg")
if os.path.exists(img1_src):
    img1 = Image.open(img1_src)
    W, H = img1.size
    print(f"Image 1 size: {W}x{H}")
    
    # Save full grid as well
    img1.save(os.path.join(out_dir, "news-grid-full.jpg"), quality=90)
    
    # 10 regions across the Pinterest grid
    # Grid has roughly 5-6 columns and 3-4 rows
    boxes_news = [
        # 1. Helmet ground down (top center-left)
        (int(W * 0.16), int(H * 0.02), int(W * 0.32), int(H * 0.35)),
        # 2. Hai thanh niên không đội mũ (top col 3)
        (int(W * 0.33), int(H * 0.02), int(W * 0.49), int(H * 0.28)),
        # 3. Infographic tỷ lệ đội mũ (top col 4)
        (int(W * 0.50), int(H * 0.02), int(W * 0.66), int(H * 0.42)),
        # 4. Trẻ em chết vì TNGT (top col 5)
        (int(W * 0.67), int(H * 0.02), int(W * 0.83), int(H * 0.28)),
        # 5. Mũ bảo hiểm rởm hại người (top right)
        (int(W * 0.84), int(H * 0.02), int(W * 0.99), int(H * 0.30)),
        # 6. Mũ thông minh sắp tung ra (col 3 row 2)
        (int(W * 0.33), int(H * 0.30), int(W * 0.49), int(H * 0.52)),
        # 7. Tác hại không đội mũ (col 2 row 2)
        (int(W * 0.16), int(H * 0.45), int(W * 0.32), int(H * 0.66)),
        # 8. Cảnh báo TNGT người già & học sinh (col 3 row 3)
        (int(W * 0.33), int(H * 0.53), int(W * 0.49), int(H * 0.85)),
        # 9. Báo động quên mũ bảo hiểm (col 5/6 row 2)
        (int(W * 0.84), int(H * 0.32), int(W * 0.99), int(H * 0.56)),
        # 10. 5 hậu quả không đội mũ (col 5 row 3)
        (int(W * 0.67), int(H * 0.65), int(W * 0.83), int(H * 0.95)),
    ]
    
    for idx, box in enumerate(boxes_news, 1):
        crop = img1.crop(box)
        crop.save(os.path.join(out_dir, f"news-{idx}.jpg"), quality=90)
        print(f"Saved news-{idx}.jpg {crop.size}")

# 3. Crop Image 2 (Helmets Products)
img2_src = os.path.join(brain_dir, "media_1789593488232.png")
if os.path.exists(img2_src):
    img2 = Image.open(img2_src)
    W2, H2 = img2.size
    print(f"Image 2 size: {W2}x{H2}")
    
    # Save full grid
    img2.save(os.path.join(out_dir, "helmets-grid-full.png"))
    
    boxes_helmets = [
        # 1. Fullface track (col 5 top)
        (int(W2 * 0.70), int(H2 * 0.10), int(W2 * 0.84), int(H2 * 0.43)),
        # 2. Mũ Royal M778K kính âm (col 3 top)
        (int(W2 * 0.27), int(H2 * 0.11), int(W2 * 0.41), int(H2 * 0.45)),
        # 3. Mũ 3/4 Ego E5 xanh lính (col 4 top)
        (int(W2 * 0.41), int(H2 * 0.00), int(W2 * 0.55), int(H2 * 0.27)),
        # 4. Mũ BRABUS lật hàm (col 3 row 2)
        (int(W2 * 0.27), int(H2 * 0.49), int(W2 * 0.41), int(H2 * 0.78)),
        # 5. Nón bảo hiểm cá heo (col 5 row 2)
        (int(W2 * 0.56), int(H2 * 0.53), int(W2 * 0.70), int(H2 * 0.84)),
        # 6. Mũ Honda nửa đầu có kính (col 2 top)
        (int(W2 * 0.12), int(H2 * 0.21), int(W2 * 0.26), int(H2 * 0.46)),
        # 7. Mũ GRO vàng thể thao (col 4 row 2)
        (int(W2 * 0.41), int(H2 * 0.58), int(W2 * 0.55), int(H2 * 0.85)),
        # 8. Mũ HJC City đen có kính (col 5 row 3)
        (int(W2 * 0.70), int(H2 * 0.52), int(W2 * 0.84), int(H2 * 0.82)),
    ]
    
    for idx, box in enumerate(boxes_helmets, 1):
        crop = img2.crop(box)
        crop.convert("RGB").save(os.path.join(out_dir, f"helmet-{idx}.jpg"), quality=90)
        print(f"Saved helmet-{idx}.jpg {crop.size}")

print("ALL ASSETS EXTRACTED SUCCESSFULLY!")
