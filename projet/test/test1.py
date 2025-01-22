import os
import mysql.connector

# Connexion à la base de données
conn = mysql.connector.connect(
    host="devbdd.iutmetz.univ-lorraine.fr",         # Adresse du serveur
    user="bouchatr1u_appli",              # Nom d'utilisateur de la base
    password="32200926",      # Mot de passe de la base
    database="bouchatr1u_projetcv3"  # Nom de la base de données
)

cursor = conn.cursor()

# Requête SQL pour récupérer toutes les colonnes
query = """
SELECT id_cv, id_utilisateur, id_anonyme, nom_fichier, type_fichier, donnees_fichier, date_telechargement
FROM CVs
"""
cursor.execute(query)

# Récupération des résultats
cvs = cursor.fetchall()

# Création du dossier de téléchargement s'il n'existe pas
download_folder = "telechargements"
if not os.path.exists(download_folder):
    os.makedirs(download_folder)

# Traitement des données récupérées
print("Liste des CVs enregistrés :")
for cv in cvs:
    id_cv = cv[0]
    id_utilisateur = cv[1]
    id_anonyme = cv[2]
    nom_fichier = cv[3]
    type_fichier = cv[4]
    donnees_fichier = cv[5]
    date_telechargement = cv[6]

    # Affichage des informations principales
    print(f"ID: {id_cv}, Utilisateur: {id_utilisateur}, Anonyme: {id_anonyme}, "
          f"Fichier: {nom_fichier}, Type: {type_fichier}, Date: {date_telechargement}")

    # Sauvegarde du fichier binaire localement
    if donnees_fichier:
        file_path = os.path.join(download_folder, nom_fichier)
        with open(file_path, "wb") as file:
            file.write(donnees_fichier)
        print(f"Fichier {nom_fichier} téléchargé dans {download_folder}")

# Fermeture de la connexion
cursor.close()
conn.close()