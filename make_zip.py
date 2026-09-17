import os
import zipfile

THEME_DIR = r"e:\biker so 1\team biker\app\public\wp-content\themes\biber-helmets"
ZIP_OUTPUT = r"e:\biker so 1\team biker\biber-helmets-moi-nhat.zip"
ZIP_OUTPUT2 = r"e:\biker so 1\team biker\app\public\wp-content\themes\biber-helmets.zip"

print(f"Dang dong goi theme tu: {THEME_DIR}")

for out_path in [ZIP_OUTPUT, ZIP_OUTPUT2]:
    with zipfile.ZipFile(out_path, 'w', zipfile.ZIP_DEFLATED) as z:
        for root, dirs, files in os.walk(THEME_DIR):
            for f in files:
                full_p = os.path.join(root, f)
                # Tên lưu bên trong zip bắt đầu bằng folder biber-helmets/
                rel_p = os.path.relpath(full_p, os.path.dirname(THEME_DIR))
                z.write(full_p, rel_p)
    print(f"-> Da tao xong: {out_path} ({os.path.getsize(out_path):,} bytes)")

print("HOAN TAT DONG GOI THEME CHUAN 100%!")
