<?php

    namespace App\Models;
    use App\Core\BaseModel;
    use App\Enums\Status;
    use App\Enums\Theme;
    use App\Enums\Langue;
    use DateTime;
    
    class User extends BaseModel {
        
        //information sur l'utilisateur
        protected int $id; //id unique fournie par le sgbd
        protected string $nom; //nom de la personne
        protected string $prenom; //prenom de la personne
        protected string $email; //email de la 
        protected string $numeroDeTelephon; //numero de telephone
    
        //information sur le compte
        protected string $role; //role de la personne (enseignant, administrateur, directeur, surveillant)
        protected Status $status; //status de compte (en-ligne, hors ligne...)
        protected Theme $theme; //dark mode ou light mode (claire ou sombre)
        protected Langue $languePreferee; //langue preferee de compte (Anglais ou Francais)
        
        //pour la securite        
        protected string $passwordHash; //on stock seulement les mots de passe hashes
        protected ?string $passwordResetToken = null; //une couche de plus de securite pour changer son mot de passe en verifiant son identite
        protected ?DateTime $passwordResetExpiry = null; //pour definir la duree de validite de token afin d'empecher la reutilisation du meme token
        protected int $failedAttempts; //compter le nombre des tentatives echouees
        public const maxloginAttempts = 5; //pour compter les tentatives echoues consicutives, eviter les attaques brute forces, et meme pour les sanctions
        protected ?DateTime $lockedUntil = null; //sanctioner les attaques brutes force avant qu'ils hackaient le compte
        public const lockTime = 30; //(veruiller le compte pour 30 minutes)  

        //pour la bonne gestion des comptes
        protected DateTime $dateDeCreation; //definition de la date de creation de compte
        protected DateTime $dernierLogin; //definition de la derniere fois ou l'ustilisateur a fait son login
        protected DateTime $dateDeMiseAjour; //dernier mise a jour

        //tant que tous mes attributs sont proteges il faut que j'aie les geters seulement (pas de setters car j'ai la methode hydrate)

        //---GETERS---
        public function getID() : int {
            return $this->id;
        }

        public function getNomComplet() : string {
            return $this->nom . ' ' . $this->prenom; 
        }

        public function getEmail() : string {
            return $this->email;
        }

        public function getNumeroDeTelephon() : string {
            return $this->numeroDeTelephon;
        }

        public function getStatus() : Status {
            return $this->statu;
        }

        public function getLangue() : Langue {
            return $this->languePreferee;
        }

        public function getTheme() : Theme {
            return $this->theme;
        }

        //verifier si le mot de pass mis comme input est valide au pas 
        public function verifyPassword(string $password) : bool {
            return password_verify($password, $this->passwordHash);
        }

        //chaque fois l'utilisateur entre un mot de pass erronee je decrimente et s'il atteindre le seuil (5 fois) le compte sera verouille
        public function failedToLogin() : void {
            $this->failedAttempts ++;
            if($this->failedAttempts >= self::maxloginAttempts){
                $this->lockedUntil = new DateTime('+' . self::lockTime . 'minutes');
            }
            //enregistrer les changements
            $this->save();
        }

        //si le login se fait parfaitement on reintialise tous et marque la derniere login
        public function successfullLogin() : void {
            $this->failedAttempts = 0;
            $this->lockedUntil = null;
            $this->dernierLogin = new DateTime(); 
            $this->save();
        }

        //si le temps ecoule (apres la sanction) je reintialise tous
        public function resetLogin() : void {
            $this->failedAttempts = 0;
            $this->lockedUntil = null;
            $this->save();
        }
    }