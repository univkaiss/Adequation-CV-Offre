const translations = {
    fr: {
        login: {
            title: "Bienvenue !",
            email: "E-mail :",
            password: "Mot de Passe :",
            forgot_password: "Vous avez oublié votre mot de passe ?",
            suivant: "Continuer",
            nocompte: "Vous n'avez pas de compte ?",
            inscrire: "Inscrivez-vous",
            aide: "Aide",
            contact: "Nous contacter"
        },
        register: {
            title: "Inscription",
            nom: "Nom :",          
            prenom: "Prénom :",       
            email: "E-mail :",
            password: "Mot de Passe :",
            confirm_password: "Confirmez votre mot de passe :",
            register_btn: "S'inscrire",
            already_account: "Vous avez déjà un compte ?",
            login_link: "Connectez-vous",
            aide: "Aide",
            contact: "Nous contacter",
            password_error: "Les mots de passe ne correspondent pas !"
        },
        settings: {
            title: "Paramètres utilisateur",
            firstname: "Prénom :",
            lastname: "Nom :",
            email: "E-mail :",
            language: "Langue par défaut :",
            save: "Enregistrer les modifications"
        },
        profil: {
            title: "Page profil",
            nom: "Nom :",
            prenom: "Prénom :",
            email: "Email :",
            date: "Date d'inscription :",
            save: "Enregistrer les modifications",
            user: "Utilisateur non trouvé.",
            aide: "Aide",
            logout: "Se déconnecter",
            language_fr: "FR",
            language_en: "EN"
        },
        aide: {
            title: "Aide",
            aide_title: "Aide",
            attention: "Votre adresse email ne peut pas être modifiée. Seuls votre nom et prénom peuvent être mis à jour par la suite sur votre page profil.",
            section_comment_utiliser: "Comment utiliser le site ?",
            comment_utiliser_description: "Notre site vous accompagne dans vos démarches de candidature en vous offrant :",
            analyse_cv_offres: "Analyse de CV et offres d'emploi : Téléchargez votre CV et fournissez un lien vers une offre d'emploi. Un taux d'adéquation sera calculé grâce à l'IA.",
            propositions_ameliorations: "Propositions d'améliorations : Si le taux est inférieur à 90 %, nous proposons des conseils pour améliorer votre CV.",
            generation_lettre: "Génération automatique de lettre de motivation : Une fois votre CV optimisé, créez une lettre de motivation adaptée à l'offre.",
            section_etapes_inscription: "Étapes pour s'inscrire et se connecter",
            inscription_title: "S'inscrire :",
            inscription_etape1: "Remplissez les champs demandés (nom, prénom, email, mot de passe).",
            inscription_etape2: "Validez votre mot de passe en le confirmant.",
            inscription_etape3: "Cliquez sur 'S'inscrire'.",
            connexion_title: "Se connecter :",
            connexion_etape1: "Accédez à la page de connexion.",
            connexion_etape2: "Saisissez votre email et mot de passe.",
            connexion_etape3: "Cliquez sur 'Continuer'.",
            section_analyse_cv: "Comment analyser votre CV ?",
            analyse_cv_description: "Connectez-vous à votre compte pour accéder à la section 'Analyse'.",
            section_lettre_motivation: "Comment créer une lettre de motivation ?",
            lettre_motivation_description: "Une fois votre CV optimisé, suivez ces étapes pour créer une lettre de motivation."
        }
    },
    en: {
        login: {
            title: "Welcome!",
            email: "Email:",
            password: "Password:",
            forgot_password: "Forgot your password?",
            suivant: "Continue",
            nocompte: "Don't have an account?",
            inscrire: "Sign up",
            aide: "Help",
            contact: "Contact us"
        },
        register: {
            title: "Register",
            nom: "Last Name:",          
            prenom: "First Name:",      
            email: "Email:",
            password: "Password:",
            confirm_password: "Confirm your password:",
            register_btn: "Sign up",
            already_account: "Already have an account?",
            login_link: "Log in",
            aide: "Help",
            contact: "Contact us",
            password_error: "Passwords do not match!"
        },
        settings: {
            title: "User Settings",
            firstname: "First Name:",
            lastname: "Last Name:",
            email: "Email:",
            language: "Default Language:",
            save: "Save Changes"
        },
        profil: {
            title: "Profile Page",
            nom: "Last Name:",
            prenom: "First Name:",
            email: "Email:",
            date: "Registration Date:",
            save: "Save changes",
            user: "User not found.",
            aide: "Help",
            logout: "Log out",
            language_fr: "FR",
            language_en: "EN"
        },
        aide: {
            title: "Help",
            aide_title: "Help",
            attention: "Your email address cannot be modified. Only your name and first name can be updated later on your profile page.",
            section_comment_utiliser: "How to use the site?",
            comment_utiliser_description: "Our site helps you with your applications by providing:",
            analyse_cv_offres: "CV and job offer analysis: Upload your CV and provide a link to a job offer. A matching score will be calculated using AI.",
            propositions_ameliorations: "Improvement suggestions: If the score is below 90%, we offer tips to improve your CV.",
            generation_lettre: "Automatic cover letter generation: Once your CV is optimized, create a tailored cover letter.",
            section_etapes_inscription: "Steps to register and log in",
            inscription_title: "Register:",
            inscription_etape1: "Fill in the required fields (name,firstname, email, password).",
            inscription_etape2: "Validate your password by confirming it.",
            inscription_etape3: "Click 'Sign up'.",
            connexion_title: "Log in:",
            connexion_etape1: "Go to the login page.",
            connexion_etape2: "Enter your email and password.",
            connexion_etape3: "Click 'Continue'.",
            section_analyse_cv: "How to analyze your CV?",
            analyse_cv_description: "Log in to your account to access the 'Analyze' section.",
            section_lettre_motivation: "How to create a cover letter?",
            lettre_motivation_description: "Once your CV is optimized, follow these steps to create a cover letter."
        }
    }
};



function switchLanguage(lang, page) {
    const content = translations[lang][page];
    Object.keys(content).forEach(key => {
        const element = document.getElementById(`${key}-label`);
        if (element) {
            element.textContent = content[key];
        }
    });

    
    const attentionElement = document.getElementById("attention-label");
    if (attentionElement) {
        attentionElement.innerHTML = `<strong>${lang === "fr" ? "Attention :" : "Warning:"}</strong> ${translations[lang]["aide"].attention}`;
    }

    const langButtons = document.querySelectorAll('.lang-btn');
    langButtons.forEach(btn => btn.classList.remove('active'));
    document.getElementById(`${lang}-btn`).classList.add('active');
}