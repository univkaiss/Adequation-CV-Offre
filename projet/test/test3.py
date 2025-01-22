import mysql.connector

# Configuration de la connexion à la base de données
config = {
    'user': 'bouchatr1u_appli',          # Remplacez par votre utilisateur MySQL
    'password': '32200926',    # Remplacez par votre mot de passe MySQL
    'host': 'devbdd.iutmetz.univ-lorraine.fr',  # Adresse du serveur MySQL
    'database': 'bouchatr1u_projetcv3',  # Nom de la base de données
}

# Fonction pour insérer une nouvelle tâche
def ajouter_tache(id_cv, id_offre, etat="En attente", date_debut=None, date_fin=None):
    try:
        # Connexion à la base de données
        conn = mysql.connector.connect(**config)
        cursor = conn.cursor()

        # Requête SQL pour insérer une tâche
        requete = """
        INSERT INTO Taches (id_cv, id_offre, etat, date_debut, date_fin)
        VALUES (%s, %s, %s, %s, %s)
        """
        valeurs = (id_cv, id_offre, etat, date_debut, date_fin)

        # Exécution de la requête
        cursor.execute(requete, valeurs)
        conn.commit()

        print(f"Tâche ajoutée avec succès. ID de la tâche : {cursor.lastrowid}")
    except mysql.connector.Error as err:
        print(f"Erreur : {err}")
    finally:
        # Fermeture de la connexion
        if conn.is_connected():
            cursor.close()
            conn.close()

# Exemple d'utilisation
ajouter_tache(
    id_cv=4,                # Remplacez par l'ID d'un CV existant
    id_offre=4,             # Remplacez par l'ID d'une offre existante
    etat="En attente",      # État initial de la tâche
    date_debut="2025-01-12 12:00:00",  # Facultatif
    date_fin=None           # Facultatif
)