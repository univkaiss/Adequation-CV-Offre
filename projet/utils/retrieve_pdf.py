import os
import mysql.connector
import sys
import json

def retrieve_pdf(id_cv, id_offre, id_tache, output_folder):
    """
    Récupère un fichier PDF depuis la base de données basé sur les IDs et l'enregistre localement.

    :param id_cv: ID du CV
    :param id_offre: ID de l'offre
    :param id_tache: ID de la tâche
    :param output_folder: Dossier où le fichier sera sauvegardé
    :return: Chemin du fichier PDF local
    """
    # Connexion à la base de données
    conn = mysql.connector.connect(
        host="localhost",
        user="projet",
        password="projetKiener",
        database="projetK"
    )
    cursor = conn.cursor()

    try:
        # Requête SQL pour récupérer le fichier PDF
        query = """
        SELECT donnees_fichier, nom_fichier
        FROM Analyses
        WHERE id_cv = %s
        """
        cursor.execute(query, (id_cv,))
        result = cursor.fetchone()

        if not result:
            print(json.dumps({'error': f"Aucun CV trouvé pour ID {id_cv}"}))
            return

        nom_fichier, donnees_fichier = result

        # Créer le dossier de téléchargement s'il n'existe pas
        if not os.path.exists(output_folder):
            os.makedirs(output_folder)

        # Sauvegarder le fichier PDF localement
        local_path = os.path.join(output_folder, nom_fichier)
        with open(local_path, "wb") as file:
            file.write(donnees_fichier)

        # Retourner le chemin du fichier PDF
        print(json.dumps({'path': local_path}))

    except Exception as e:
        print(json.dumps({'error': str(e)}))
    finally:
        cursor.close()
        conn.close()

# Récupérer les paramètres depuis les arguments de la ligne de commande
if __name__ == "__main__":
    id_cv = sys.argv[1]
    id_offre = sys.argv[2]
    id_tache = sys.argv[3]
    output_folder = sys.argv[4]
    retrieve_pdf(id_cv, id_offre, id_tache, output_folder)
