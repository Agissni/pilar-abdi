import os

base_dir = r"c:\xampp\htdocs\pilar-abdi\pilar-abdi"
keywords = ["ruangan", "tatap", "luring", "offline", "hybrid", "hibrid"]

print("Scanning for offline-related keywords...")
for root, dirs, files in os.walk(base_dir):
    if any(exclude in root for exclude in [".git", "node_modules", "vendor", "storage", "bootstrap"]):
        continue
    for file in files:
        if file.endswith((".php", ".json", ".js", ".md", ".css", ".html")):
            path = os.path.join(root, file)
            try:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    content = f.read()
                    for kw in keywords:
                        if kw in content.lower():
                            lines = content.split("\n")
                            for i, line in enumerate(lines):
                                if kw in line.lower():
                                    print(f"{os.path.relpath(path, base_dir)}:{i+1} ({kw}): {line.strip()}")
            except Exception as e:
                pass
