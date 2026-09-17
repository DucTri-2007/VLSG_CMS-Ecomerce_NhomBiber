"""
Script cắt tự động 10 ảnh bài viết từ Ảnh 1 và 8 ảnh mũ bảo hiểm từ Ảnh 2
Dùng thư viện Pillow (PIL)
"""
import os
from PIL import Image

BRAIN_DIR = r"C:\Users\DELL\.gemini\antigravity-ide\brain\5856ad80-eeba-4418-8864-3975bbbf4396\.user_uploaded"
THEME_DIR = r"E:\biker so 1\team biker\app\public\wp-content\themes\biber-helmets"
IMG_DIR = os.path.join(THEME_DIR, "assets", "images")

os.makedirs(IMG_DIR, exist_ok=True)

# 1. Logo
logo_src = os.path.join(BRAIN_DIR, "media_1789593552551.png")
logo_dst = os.path.join(IMG_DIR, "biker-logo.png")
if os.path.exists(logo_src):
    try:
        im = Image.open(logo_src)
        im.save(logo_dst)
        print(f"[OK] Logo saved to {logo_dst}")
    except Exception as e:
        print(f"[ERR] Logo error: {e}")

# 2. Cắt 10 ảnh bài viết từ Ảnh 1 (media_1789593307046.jpg)
news_src = os.path.join(BRAIN_DIR, "media_1789593307046.jpg")
if not os.path.exists(news_src):
    news_src = os.path.join(IMG_DIR, "news-grid-full.jpg")

if os.path.exists(news_src):
    try:
        im = Image.open(news_src)
        w, h = im.size
        # Copy full grid
        im.save(os.path.join(IMG_DIR, "news-grid-full.jpg"), quality=90)
        
        boxes = {
            1:  (int(w * 0.16), int(h * 0.02), int(w * 0.32), int(h * 0.35)),
            2:  (int(w * 0.33), int(h * 0.02), int(w * 0.49), int(h * 0.28)),
            3:  (int(w * 0.50), int(h * 0.02), int(w * 0.66), int(h * 0.42)),
            4:  (int(w * 0.67), int(h * 0.02), int(w * 0.83), int(h * 0.28)),
            5:  (int(w * 0.84), int(h * 0.02), int(w * 0.99), int(h * 0.30)),
            6:  (int(w * 0.33), int(h * 0.30), int(w * 0.49), int(h * 0.52)),
            7:  (int(w * 0.16), int(h * 0.45), int(w * 0.32), int(h * 0.66)),
            8:  (int(w * 0.33), int(h * 0.53), int(w * 0.49), int(h * 0.85)),
            9:  (int(w * 0.84), int(h * 0.32), int(w * 0.99), int(h * 0.56)),
            10: (int(w * 0.67), int(h * 0.65), int(w * 0.83), int(h * 0.95)),
        }
        for i, box in boxes.items():
            crop_im = im.crop(box)
            crop_path = os.path.join(IMG_DIR, f"news-{i}.jpg")
            crop_im.save(crop_path, quality=90)
            print(f"[OK] News {i} saved -> {crop_path}")
    except Exception as e:
        print(f"[ERR] News crop error: {e}")

# 3. Cắt 8 ảnh mũ bảo hiểm từ Ảnh 2 (media_1789593488232.png)
helm_src = os.path.join(BRAIN_DIR, "media_1789593488232.png")
if not os.path.exists(helm_src):
    helm_src = os.path.join(IMG_DIR, "helmets-grid-full.png")

if os.path.exists(helm_src):
    try:
        im = Image.open(helm_src)
        w, h = im.size
        im.save(os.path.join(IMG_DIR, "helmets-grid-full.png"))
        
        boxes2 = {
            1: (int(w * 0.70), int(h * 0.10), int(w * 0.84), int(h * 0.43)),
            2: (int(w * 0.27), int(h * 0.11), int(w * 0.41), int(h * 0.45)),
            3: (int(w * 0.41), int(h * 0.00), int(w * 0.55), int(h * 0.27)),
            4: (int(w * 0.27), int(h * 0.49), int(w * 0.41), int(h * 0.78)),
            5: (int(w * 0.56), int(h * 0.53), int(w * 0.70), int(h * 0.84)),
            6: (int(w * 0.12), int(h * 0.21), int(w * 0.26), int(h * 0.46)),
            7: (int(w * 0.41), int(h * 0.58), int(w * 0.55), int(h * 0.85)),
            8: (int(w * 0.70), int(h * 0.52), int(w * 0.84), int(h * 0.82)),
        }
        for i, box in boxes2.items():
            crop_im = im.crop(box)
            crop_path = os.path.join(IMG_DIR, f"helmet-{i}.jpg")
            crop_im.convert("RGB").save(crop_path, quality=90)
            print(f"[OK] Helmet {i} saved -> {crop_path}")
    except Exception as e:
        print(f"[ERR] Helmet crop error: {e}")

print("Done all asset cropping!")
