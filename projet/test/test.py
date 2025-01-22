import mysql.connector
from uuid import uuid4

# Connexion à la base de données
conn = mysql.connector.connect(
    host="devbdd.iutmetz.univ-lorraine.fr",
    user="bouchatr1u_appli",
    password="32200926",
    database="bouchatr1u_projetcv3"
)
cursor = conn.cursor()

# Lecture du fichier CV
file_path = "/Applications/XAMPP/xamppfiles/htdocs/DevWeb/projetCV/projet/uploads/CV KAISS.pdf"  # Remplace par le chemin du fichier CV
with open(file_path, "rb") as file:
    file_data = file.read()

# Informations sur le fichier
file_name = "CV KAISS.pdf"  # Remplace par le nom du fichier CV
file_type = "pdf"  # Assurez-vous que le type correspond à l'un des types permis dans `type_fichier`

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