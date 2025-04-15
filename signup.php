<?php

class Compte {
    private $pseudo;
    private $email;
    private $mot_de_passe;
    private $confirmation_mot_de_passe;

    public function __construct($pseudo, $email, $mot_de_passe, $confirmation_mot_de_passe) {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->confirmation_mot_de_passe = $confirmation_mot_de_passe;
    }

    public function enregistrer() {
        if ($this->mot_de_passe !== $this->confirmation_mot_de_passe) {
            return "Les mots de passe ne correspondent pas.";
        }
        // Add your registration logic here
        return "Compte créé avec succès!";
    }
}
?>