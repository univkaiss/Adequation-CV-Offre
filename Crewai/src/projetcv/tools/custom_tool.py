from crewai.tools import BaseTool
from typing import Type
from pydantic import BaseModel, Field
import os
from PyPDF2 import PdfReader
from docx import Document

class FileReaderInput(BaseModel):
    """Input schema for FileReaderTool."""
    file_path: str = Field(..., description="The path to the file to be read.")

class FileReaderTool(BaseTool):
    name: str = "file_reader_tool"
    description: str = (
        "A tool that reads the content of files. It supports PDF and Word documents. "
        "Provide the file path as input, and it will return the file's text content."
    )
    args_schema: Type[BaseModel] = FileReaderInput

    def _run(self, file_path: str) -> str:
        """
        Reads the content of a file and returns it as a string.
        Supports PDF and Word documents.
        """
        if not os.path.exists(file_path):
            return f"Error: The file at path '{file_path}' does not exist."

        file_extension = os.path.splitext(file_path)[1].lower()

        try:
            if file_extension == ".pdf":
                return self._read_pdf(file_path)
            elif file_extension == ".docx":
                return self._read_word(file_path)
            else:
                return f"Error: Unsupported file format '{file_extension}'. Only .pdf and .docx are supported."
        except Exception as e:
            return f"Error reading file: {str(e)}"

    def _read_pdf(self, file_path: str) -> str:
        """Reads a PDF file and returns its content."""
        try:
            reader = PdfReader(file_path)
            text = ""
            for page in reader.pages:
                text += page.extract_text()
            return text if text else "No text content found in the PDF."
        except Exception as e:
            return f"Error reading PDF: {str(e)}"

    def _read_word(self, file_path: str) -> str:
        """Reads a Word document (.docx) and returns its content."""
        try:
            doc = Document(file_path)
            return "\n".join([paragraph.text for paragraph in doc.paragraphs])
        except Exception as e:
            return f"Error reading Word document: {str(e)}"
