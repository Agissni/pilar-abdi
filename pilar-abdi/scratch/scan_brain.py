import os

base_dir = r"C:\Users\UseR\.gemini\antigravity\brain\ad57fc38-7777-46dc-98f2-92c7c0c6c7d1"
keywords = ["ruangan", "tatap", "luring", "offline", "hybrid", "hibrid"]

print("Scanning brain directory...")
for root, dirs, files in os.walk(base_dir):
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
                                    print(f"{file}:{i+1} ({kw}): {line.strip()}")
            except Exception as e:
                pass
