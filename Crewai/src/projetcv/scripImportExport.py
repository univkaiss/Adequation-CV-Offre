import mysql.connector
import subprocess
import os
import json
from datetime import datetime
from time import sleep
import markdown2
import pdfkit
import pypandoc
from PyPDF2 import PdfReader

# Configuration de la base de données
db_config = {
    'host': 'localhost',
    'user': 'projet',
    'password': 'projetKiener',
    'database': 'projetK'
}

def read_toml():
    # Spécifiez le chemin complet du fichier pyproject.toml
    file_path = "/home/ia/projetcv/pyproject.toml"
    with open(file_path, "rb") as f:
        return toml.load(f)

# Fonction pour surveiller les tâches
def get_pending_tasks():
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor(dictionary=True)
    query = "SELECT * FROM Taches WHERE etat = 'En attente' LIMIT 1;"
    cursor.execute(query)
    task = cursor.fetchone()
    cursor.close()
    connection.close()
    return task

def get_cv_offre(cv_id, offre_id):
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor(dictionary=True)
    
    # Récupérer les informations du CV
    query_cv = "SELECT nom_fichier, donnees_fichier FROM CVs WHERE id_cv = %s;"
    cursor.execute(query_cv, (cv_id,))
    cv = cursor.fetchone()
    print(f"Query CV result: {cv}")
    
    # Récupérer les informations de l'offre
    query_offre = "SELECT * FROM Offres WHERE id_offre = %s;"
    cursor.execute(query_offre, (offre_id,))
    offre = cursor.fetchone()
    print(f"Query Offer result: {offre}")
    
    cursor.close()
    connection.close()
    return cv, offre

# Fonction pour vérifier si une analyse existe déjà pour un CV donné
def analysis_exists(cv_id):
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()
    query = "SELECT COUNT(*) FROM Analyses WHERE id_cv = %s;"
    cursor.execute(query, (cv_id,))
    count = cursor.fetchone()[0]
    cursor.close()
    connection.close()
    return count > 0

def upsert_analysis_results(cv_id, offre_id, suggestions, statistiques, lettre_de_motivation, nom_fichier):
    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor()
        date_analyse = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

        if analysis_exists(cv_id):
            # Mettre à jour l'analyse existante
            query = """
                UPDATE Analyses
                SET id_offre = %s, suggestions = %s, statistiques = %s, date_analyse = %s, lettre_de_motivation = %s, nom_fichier = %s
                WHERE id_cv = %s
            """
            print(f"Updating analysis for CV ID {cv_id}")
            cursor.execute(query, (offre_id, suggestions, statistiques, date_analyse, lettre_de_motivation, nom_fichier, cv_id))
        else:
            # Insérer une nouvelle analyse
            query = """
                INSERT INTO Analyses (id_cv, id_offre, suggestions, statistiques, date_analyse, lettre_de_motivation, nom_fichier)
                VALUES (%s, %s, %s, %s, %s, %s, %s)
            """
            print(f"Inserting new analysis for CV ID {cv_id}")
            cursor.execute(query, (cv_id, offre_id, suggestions, statistiques, date_analyse, lettre_de_motivation, nom_fichier))

        connection.commit()
        print(f"Database operation successful for CV ID {cv_id}")

    except mysql.connector.Error as e:
        print(f"Database error: {e}")

    finally:
        cursor.close()
        connection.close()

def read_pdf(file_path):
    """
    Lit le contenu texte d'un fichier PDF.

    :param file_path: Chemin du fichier PDF à lire.
    :return: Contenu texte du PDF.
    """
    try:
        reader = PdfReader(file_path)
        text = ""
        for page in reader.pages:
            text += page.extract_text() + "\n"
        return text
    except Exception as e:
        print(f"Erreur lors de la lecture du fichier PDF : {e}")
        return None


# Fonction principale
def process_task():
    print("Checking for pending tasks...")
    task = get_pending_tasks()
    if task:
        print(f"Pending task found: {task}")
        cv_id = task['id_cv']
        offre_id = task['id_offre']
        print(f"CV ID: {cv_id}, Offer ID: {offre_id}")
        cv, offre = get_cv_offre(cv_id, offre_id)
        print(f"CV: {cv}, Offer: {offre}")

        tmp = True  # Initialiser tmp à True après la récupération de cv et offre

        if tmp:
            print(f"CV and offer found: CV ID = {cv_id}, Offer ID = {offre_id}")

              # Sauvegarder le fichier CV dans un dossier spécifique
            save_directory = "/home/ia/projetcv/src/projetcv/resources/"
            os.makedirs(save_directory, exist_ok=True)
            cv_file_path = os.path.join(save_directory, cv['nom_fichier'])
            with open(cv_file_path, "wb") as f:
                f.write(cv['donnees_fichier'])
            print(f"CV file saved to {cv_file_path}")

             # Exporter les variables dans un fichier JSON
            variables = {
                'cv_file_path': cv_file_path,
                'job_description': offre['lien_offre']
            }
            with open('/tmp/variables.json', 'w') as json_file:
                json.dump(variables, json_file)
            print("Variables exported to /tmp/variables.json")

            try:
                # Activer l'environnement virtuel et lancer les agents CrewAI
                command = ["/bin/bash", "-c", "cd /home/ia/projetcv && source /home/ia/crewai_env/bin/activate && crewai run"]
                print(f"Running command: {command}")
                result = subprocess.run(command, capture_output=True, text=True)
                print("CrewAI output:")
                print(result.stdout)
                if result.stderr:
                    print("CrewAI errors:")
                    print(result.stderr)

                # Lecture des fichiers de résultats des agents
                with open("/home/ia/projetcv/improved_cv.md", "r") as file:
                    suggestions = file.read()

                with open("/home/ia/projetcv/report.md", "r") as file:
                    statistiques = file.read()

                
                #convertir_md_en_pdf('/home/ia/projetcv/lettre_de_motivation.md', '/home/ia/projetcv/')
                pdf = "/home/ia/projetcv/motivation_letter.pdf"
                lettre_de_motivation = read_pdf(pdf)

                nom_fichier = "lettre_de_motivation.pdf"
                upsert_analysis_results(cv_id, offre_id, suggestions, statistiques, lettre_de_motivation, nom_fichier)
                
                # Mettre à jour le statut de la tâche
                connection = mysql.connector.connect(**db_config)
                cursor = connection.cursor()
                update_query = "UPDATE Taches SET etat = 'Termine' WHERE id_tache = %s;"
                cursor.execute(update_query, (task['id_tache'],))
                connection.commit()
                cursor.close()
                connection.close()
                print("Task status updated to 'terminée'")

            except subprocess.CalledProcessError as e:
                print(f"Erreur lors de l'exécution de CrewAI : {e}")

# Exécution en boucle
if __name__ == "__main__":
    while True:
        process_task()
        # Attendre 5 secondes avant de vérifier à nouveau
        sleep(5)