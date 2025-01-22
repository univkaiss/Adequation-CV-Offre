import os
from pathlib import Path
import PyPDF2
import docx
import sys

def convertir_fichier_en_txt(chemin_fichier):
    """
    Convertit un fichier PDF ou DOC en TXT.
    
    Args:
        chemin_fichier (str): Chemin vers le fichier à convertir
        
    Returns:
        str: Message indiquant le résultat de la conversion
    """
    # Obtenir le chemin du fichier de sortie TXT
    chemin = Path(chemin_fichier)
    chemin_fichier_txt = chemin.parent / f"{chemin.stem}.txt"
    
    # Vérifier si le fichier existe
    if not os.path.exists(chemin_fichier):
        return "Le fichier n'existe pas."
    
    # Vérifier l'extension du fichier
    extension_fichier = chemin.suffix.lower()[1:]  # Enlever le point
    if extension_fichier not in ['pdf', 'doc', 'docx']:
        return "Format de fichier invalide. Seuls les fichiers PDF et DOC/DOCX sont pris en charge."
    
    try:
        # Convertir PDF en TXT
        if extension_fichier == 'pdf':
            contenu_txt = conversion_pdf_en_txt(chemin_fichier)
            
        # Convertir DOC/DOCX en TXT
        elif extension_fichier in ['doc', 'docx']:
            contenu_txt = conversion_doc_en_txt(chemin_fichier)
        
        # Écrire le contenu dans le fichier TXT
        with open(chemin_fichier_txt, 'w', encoding='utf-8') as f:
            f.write(contenu_txt)
            
        return f"Fichier converti avec succès. Fichier TXT enregistré à l'emplacement : {chemin_fichier_txt}"
        
    except Exception as e:
        return f"Erreur lors de la conversion : {str(e)}"

def conversion_pdf_en_txt(chemin_fichier):
    """
    Convertit un fichier PDF en texte.
    
    Args:
        chemin_fichier (str): Chemin vers le fichier PDF
        
    Returns:
        str: Contenu texte du PDF
    """
    texte = ""
    
    with open(chemin_fichier, 'rb') as file:
        # Créer un objet PDF reader
        pdf_reader = PyPDF2.PdfReader(file)
        
        # Extraire le texte de chaque page
        for page in pdf_reader.pages:
            texte += page.extract_text() + "\n"
    
    return texte

def conversion_doc_en_txt(chemin_fichier):
    """
    Convertit un fichier DOC/DOCX en texte.
    
    Args:
        chemin_fichier (str): Chemin vers le fichier DOC/DOCX
        
    Returns:
        str: Contenu texte du document
    """
    doc = docx.Document(chemin_fichier)
    texte = ""
    
    # Extraire le texte de chaque paragraphe
    for para in doc.paragraphs:
        texte += para.text + "\n"
    
    return texte

if __name__ == "__main__":
    # Permet d'utiliser le script en ligne de commande
    if len(sys.argv) != 2:
        print("Usage: python script.py chemin_vers_fichier")
        sys.exit(1)
        
    resultat = convertir_fichier_en_txt(sys.argv[1])
    print(resultat)