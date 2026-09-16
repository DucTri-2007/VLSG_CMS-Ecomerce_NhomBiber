import re
import os

html_path = r"d:\team biker\app\public\trang-chu.html"
theme_dir = r"d:\team biker\app\public\wp-content\themes\biber-helmets"

with open(html_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Extract CSS
style_match = re.search(r'<style>(.*?)</style>', content, re.DOTALL)
if style_match:
    css_content = style_match.group(1)
    # Remove <style> tag from content
    content = content.replace(f"<style>{css_content}</style>", "<!-- CSS moved to style.css -->")
else:
    css_content = ""

style_css = """/*
Theme Name: Biber Helmets
Description: Custom WordPress theme converted from HTML.
Author: Antigravity
Version: 1.0
*/
""" + css_content

# Extract Header part (from <!DOCTYPE to </header>)
header_match = re.search(r'(<!DOCTYPE html>.*?</header>)', content, re.DOTALL)
header_content = header_match.group(1) if header_match else ""

# Extract Footer part (from <footer to </html>)
footer_match = re.search(r'(<footer class="site-footer">.*?</html>)', content, re.DOTALL)
footer_content = footer_match.group(1) if footer_match else ""

# Extract Body part (between header and footer)
body_match = re.search(r'</header>\s*(.*?)\s*<footer class="site-footer">', content, re.DOTALL)
body_content = body_match.group(1) if body_match else ""

# Prepare WordPress specific header/footer
header_php = header_content.replace(
    '</head>',
    '<?php wp_head(); ?>\n</head>'
)

# Update images in index.php
body_content = re.sub(r'src="\.\/([^"]+)"', r'src="<?php echo get_template_directory_uri(); ?>/\1"', body_content)

index_php = "<?php get_header(); ?>\n" + body_content + "\n<?php get_footer(); ?>"

footer_php = footer_content.replace(
    '</body>',
    '<?php wp_footer(); ?>\n</body>'
)

functions_php = """<?php
function biber_helmets_enqueue_styles() {
    wp_enqueue_style('biber-helmets-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'biber_helmets_enqueue_styles');
"""

# Write files
os.makedirs(theme_dir, exist_ok=True)
with open(os.path.join(theme_dir, 'style.css'), 'w', encoding='utf-8') as f:
    f.write(style_css)
with open(os.path.join(theme_dir, 'header.php'), 'w', encoding='utf-8') as f:
    f.write(header_php)
with open(os.path.join(theme_dir, 'footer.php'), 'w', encoding='utf-8') as f:
    f.write(footer_php)
with open(os.path.join(theme_dir, 'index.php'), 'w', encoding='utf-8') as f:
    f.write(index_php)
with open(os.path.join(theme_dir, 'functions.php'), 'w', encoding='utf-8') as f:
    f.write(functions_php)

print("Theme created successfully.")
