import docx
import os


def choice_latest_docx(folder_path):
    docx_files = [f for f in os.listdir(folder_path) if f.endswith(".docx")]
    latest_file_path = ""
    latest_time = 0
    for file_path in docx_files:
        full_path = os.path.join(folder_path, file_path)
        file_time = os.path.getmtime(full_path)
        if file_time > latest_time:
            latest_file_path = full_path
            latest_time = file_time
    return latest_file_path


def extract_text_from_docx(file_path):
    doc = docx.Document(file_path)
    full_text = []
    for para in doc.paragraphs:
        full_text.append(para.text)
    return "\n".join(full_text)


# ドキュメントファイル検索
folder_path = "./uploads"
latest_document_file_path = choice_latest_docx(folder_path)

# テキスト変換
file_path = "./uploads/document.docx"
text = extract_text_from_docx(latest_document_file_path)

# テキストファイルに書き込み
with open("./uploads/uploadedTextFile.txt", mode="w", encoding="UTF-8") as f:
    f.write(text)
