import os

docs_dir = r"c:\xampp\htdocs\pilar-abdi\pilar-abdi\dokumentasi"
keywords = ["offline", "luring", "hybrid", "hibrid", "tatap muka", "konvensional", "langsung", "campur", "online"]

print("Scanning documentation files...")
for filename in os.listdir(docs_dir):
    if filename.endswith(".md"):
        path = os.path.join(docs_dir, filename)
        with open(path, "r", encoding="utf-8") as f:
            content = f.read()
            for kw in keywords:
                if kw in content.lower():
                    # Find lines containing keyword
                    lines = content.split("\n")
                    for i, line in enumerate(lines):
                        if kw in line.lower():
                            print(f"{filename}:{i+1} ({kw}): {line}")
