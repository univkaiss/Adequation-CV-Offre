import mysql.connector
from uuid import uuid4

# Connexion à la base de données
conn = mysql.connector.connect(
    host="localhost",  # Assurez-vous que l'hôte est correct, "localhost" ou l'adresse IP du serveur
    user="projet",  # Remplacez par l'utilisateur de votre base de données
    password="projetKiener",  # Remplacez par le mot de passe de l'utilisateur
    database="projetcv"  # Remplacez par le nom de votre base de données
)
cursor = conn.cursor()

# Lecture du fichier CV
file_path = "/home/ia/projetcv/src/projetcv/resources/faux_CV_jardinier.pdf"  # Remplace par le chemin du fichier CV
with open(file_path, "rb") as file:
    file_data = file.read()

# Informations sur le fichier
file_name = "faux_CV_jardinier.pdf"  # Remplace par le nom du fichier CV
file_type = "pdf"  # Modifié à "txt", car le fichier semble être un fichier texte, et non un PDF

# Insertion des données
query = """
INSERT INTO CVs (id_utilisateur, id_anonyme, nom_fichier, type_fichier, donnees_fichier, date_telechargement)
VALUES (%s, %s, %s, %s, %s, NOW())
"""
values = (None, str(uuid4()), file_name, file_type, file_data)

cursor.execute(query, values)
conn.commit()

print("CV inséré avec succès avec ID :", cursor.lastrowid)

# Fermeture de la connexion
cursor.close()
conn.close()
