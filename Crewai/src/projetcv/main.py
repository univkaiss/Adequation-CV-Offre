#!/usr/bin/env python
import sys
import warnings

import litellm

import json

from projetcv.crew import Projetcv

import pdfplumber

#from scripImportExport import nom_fichier, offre


warnings.filterwarnings("ignore")



#warnings.filterwarnings("ignore", category=SyntaxWarning, module="pysbd")

# This main file is intended to be a way for you to run your
# crew locally, so refrain from adding unnecessary logic into this file.
# Replace with inputs you want to test with, it will automatically
# interpolate any tasks and agents information



def load_cv_content(file_path):
    """
    Load the content of a CV file in plain text or PDF.

    :param file_path: Path to the CV file.
    :return: Content of the file as a string.
    """
    try:
        if file_path.lower().endswith('.pdf'):
            # Lire le contenu du fichier PDF avec pdfplumber
            with pdfplumber.open(file_path) as pdf:
                content = ""
                for page in pdf.pages:
                    content += page.extract_text()
            return content
        else:
            # Lire le contenu du fichier texte
            with open(file_path, 'r', encoding='utf-8') as file:
                return file.read()
    except Exception as e:
        raise Exception(f"Error reading CV file: {e}")

def run():
    """
    Run the crew.
    """
    # Lire les variables depuis le fichier JSON
    with open('/tmp/variables.json', 'r') as json_file:
        variables = json.load(json_file)

    cv_file_path = variables['cv_file_path']
    job_description = variables['job_description']

    cv_content = load_cv_content(cv_file_path)
    grille_file_path = '/home/ia/projetcv/src/projetcv/resources/grille_eval.txt'
    grille_eval = load_cv_content(grille_file_path)

    inputs = {
        'cv_content': cv_content,
        'job_description': job_description,
        'grille_eval': grille_eval
    }
    
    Projetcv().crew().kickoff(inputs=inputs)


def train():
    """
    Train the crew for a given number of iterations.
    """
    cv_file_path = '/home/ia/projetcv/src/projetcv/resources/CV_KAISS.txt'
    cv_content = load_cv_content(cv_file_path)
    grille_file_path = '/home/ia/projetcv/src/projetcv/resources/grille_eval.txt'
    grille_eval = load_cv_content(grille_file_path)

    job_description = 'https://fr.indeed.com/q-plombier-l-metz-(57)-emplois.html?vjk=4ced396e56649451&advn=8450154512018876'

    inputs = {
        'cv_content': cv_contents,
        'job_description': job_description,
        'grille_eval': grille_eval
    }
    
    n_iterations = 5  # Nombre d'itérations pour l'entraînement
    filename = 'trained_agents_data.pkl'  # Nom du fichier pour sauvegarder les données entraînées
    
    task_id = Projetcv().crew().train(inputs=inputs, n_iterations=n_iterations, filename=filename)
    print(f"Training completed. Task ID: {task_id}")


def replay():
    """
    Replay the crew execution from a specific task.
    """
    try:
        Projetcv().crew().replay(task_id=sys.argv[1])

    except Exception as e:
        raise Exception(f"An error occurred while replaying the crew: {e}")

def test():
    """
    Test the crew execution and returns the results.
    """
    inputs = {
        "topic": "AI LLMs"
    }
    try:
        Projetcv().crew().test(n_iterations=5, openai_model_name="llama3.2", inputs=inputs)

    except Exception as e:
        raise Exception(f"An error occurred while testing the crew: {e}")
