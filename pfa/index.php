<?php

    session_start();
    //j'appelle mon autoloader
    // (le truc qui sert a appeller les classes au moment d'instanciation automatiquemant   sans faire des requires)
    require_once __DIR__ . '/autoload.php';

    //j'appelle mes namespaces

    use App\Controllers\AuthController;
    use App\Controllers\EnseignantController;
    use App\Controllers\AdministrateurController;
    use App\Controllers\PageController;

    //je recupere l'url et la request method pour faire le routing

    $url = $_GET["url"] ?? '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    //rouatage mannuel
    //je vais utiliser ca (->) pour signifier rediriger
    switch ($url){
        //le cas par defaut -> Home (l'index)
        case '':
            require_once __DIR__ . '/Views/Partials/portail.php';
            break;

        case 'contact':
            require_once __DIR__ . '/Views/Partials/Contact.inc.php';
            break;
        
        case 'login':
            require_once __DIR__ . '/Views/Auth/log-in.php';
            break;
        case 'loginHandler':
            require_once __DIR__ . '/App/Controllers/AuthController';
            break;
            
    
        case 'logout':
            $controller = new AuthController();
            $controller->LogOut();
            break;
        //routage selon role
        //Enseignant
        case 'enseignant/dashboard':
            $controller = new EnseignantController();
            $controller->dashboard();
            break;

        case 'enseignant/fichAppel':
            $controller = new EnseignantController();
            $controller->faireAppel();
            break;
        
        case 'enseignant/ajouterNotes':
            $controller = new EnseignantController();
            $controller->ajouterNotes();
            break;

        //Directeur
        case 'administrateur/dashboard':
            $controller = new AdministrateurController();
            $controller->dashboard();
            break;

        default :
            http_response_code(404);
            echo "<h1>ERROR-404 Page introvable</h1> <br>";
            echo "<p>La page demande n'existe pas</p> <br>";
            echo "<a href='/pfa'>Revenir a la page d'acceuille</a>";
            break;
        }