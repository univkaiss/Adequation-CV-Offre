<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once("../modele/utilisateurDAO.php");
    require_once("../modele/cvsDAO.php");
    require_once("../modele/analyseDAO.php");
    require_once("../modele/historiqueDAO.php");
    require_once("../modele/offreDAO.php");
    require_once("../modele/tachesDAO.php");

    $utilisateurDAO = new UtilisateurDAO();
    $cvsDAO = new CVsDAO();
    $AnalyseDAO = new analyseDAO();
    $historiqueDAO = new HistoriqueDAO();
    $offreDAO = new OffreDAO();
    $tachesDAO = new TachesDAO();


    session_start();
       
    

    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $utilisateur = $utilisateurDAO->getByEmail($_SESSION['email']);

        $idUtilisateur = $utilisateur->getIdUtilisateur();

        $utilisateurDAO->delete($idUtilisateur);
        $offreDAO->deleteByIdUtilisateur($idUtilisateur);

        $cvsUser = $cvsDAO->getAllByUserId2($idUtilisateur);
      

        if (!empty($cvsUser)) {
            foreach ($cvsUser as $cv) {
                $idCV = $cv->getIdCv();

                $cvsDAO->delete($idCV);
                $tachesDAO->deleteByIdCV($idCV);
                $AnalyseDAO->deleteByIdCV($idCV);
                $historiqueDAO->deleteByIdCV($idCV);
            }
        }


        // header("location: login.php");
        // exit;
    }
    
    if (isset($_POST['action']) && $_POST['action'] === 'logout') {
        session_destroy();
        header("location: login.php");
        exit;
    }

    $valeurs['nom'] = (isset($_POST['nom']) ? trim($_POST['nom']) : null);
    $valeurs['prenom'] = (isset($_POST['prenom']) ? trim($_POST['prenom']) : null);


    if($valeurs['nom'] && $valeurs['prenom']){
        // $utilisateurDAO
        $utilisateur = $utilisateurDAO->getByEmail($_SESSION['email']);

        $utilisateur->setNom( $valeurs['nom']);
        $utilisateur->setPrenom($valeurs['prenom']);
        $utilisateurDAO->update($utilisateur);
        require_once("../public/pageProfil.view.php");
    }
    else{
        if (isset($_SESSION['email'])) {
            $utilisateur = $utilisateurDAO->getByEmail($_SESSION['email']);
            require_once("../public/pageProfil.view.php");
        } else {
            header("location: login.php");
            exit;
        }
    }

?>