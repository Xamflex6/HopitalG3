<?php
// Inclusion du fichier Modele.php pour la connexion à la base de données ou d'autres configurations globales.
require_once __DIR__ . '/../config/Modele.php';

/**
 * Classe AuthModele
 * Cette classe permet de gérer l'authentification des utilisateurs via un serveur LDAP.
 */
class AuthModele {

    // Paramètres de connexion au serveur LDAP
    private $ldapHost = 'ldap://192.168.100.2'; // Adresse du serveur LDAP
    private $ldapPort = 389;                   // Port utilisé pour la connexion LDAP (par défaut : 389)
    private $ldapBaseDn = 'DC=hopital,DC=lan'; // Base DN (Distinguished Name) pour la recherche LDAP

    /**
     * Méthode pour vérifier les informations d'authentification d'un utilisateur via LDAP.
     * 
     * @param string $username Le nom d'utilisateur à vérifier.
     * @param string $motDePasse Le mot de passe correspondant à l'utilisateur.
     * @return array|bool Retourne un tableau contenant les informations utilisateur si l'authentification réussit, sinon `false`.
     */
    public function verifierUtilisateurLDAP($username, $motDePasse) {
        // Connexion au serveur LDAP
        $ldapConnection = ldap_connect($this->ldapHost, $this->ldapPort);

        // Si la connexion échoue
        if (!$ldapConnection) {
            return false;
        }

        // Configuration des options LDAP : version du protocole et désactivation des références.
        ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapConnection, LDAP_OPT_REFERRALS, 0);

        // Tentative de liaison (bind) LDAP avec le nom d'utilisateur et le mot de passe
        $ldapBind = @ldap_bind($ldapConnection, $username . "@hopital.lan", $motDePasse);

        // Si l'authentification échoue
        if (!$ldapBind) {
            $_SESSION['error'] = "Échec de l'authentification : mot de passe incorrect.";
            ldap_close($ldapConnection); // Fermeture de la connexion LDAP
            return false;
        }

        // Filtre de recherche LDAP pour trouver l'utilisateur
        $searchFilter = "(AccountName=$username)";

        // Recherche dans l'annuaire LDAP
        $searchResult = @ldap_search($ldapConnection, $this->ldapBaseDn, $searchFilter);

        // Si la recherche échoue
        if (!$searchResult) {
            $_SESSION['error'] = "Erreur LDAP lors de la recherche : " . ldap_error($ldapConnection);
            ldap_close($ldapConnection); // Fermeture de la connexion LDAP
            return false;
        }

        // Récupération des résultats de la recherche
        $entries = ldap_get_entries($ldapConnection, $searchResult);

        // Si aucun utilisateur n'est trouvé
        if ($entries['count'] === 0) {
            $_SESSION['error'] = "Utilisateur non trouvé dans le répertoire LDAP.";
            ldap_close($ldapConnection); // Fermeture de la connexion LDAP
            return false;
        }

        // Récupération du DN (Distinguished Name) de l'utilisateur
        $userDn = $entries[0]['dn'];

        // Nouvelle tentative de liaison LDAP avec le DN et le mot de passe
        if (@ldap_bind($ldapConnection, $userDn, $motDePasse)) {
            // Définition du rôle par défaut
            $role = 'user';

            // Récupération des groupes auxquels appartient l'utilisateur (optionnel)
            $memberOf = $entries[0]['memberof'] ?? [];

            // Exemple de gestion des rôles en fonction des groupes LDAP (désactivé ici)
            // if (is_array($memberOf) && in_array('CN=GG_ADMIN,OU=GG,OU=Groups,DC=hopital,DC=lan', $memberOf)) {
            //     $role = 'admin';
            // }

            // Déconnexion du serveur LDAP
            ldap_unbind($ldapConnection);

            // Retourne les informations de l'utilisateur (nom, prénom, email, rôle)
            return [
                'nom' => $entries[0]['sn'][0] ?? '',           // Nom de l'utilisateur
                'prenom' => $entries[0]['givenname'][0] ?? '', // Prénom de l'utilisateur
                'email' => $entries[0]['mail'][0] ?? '',       // Email de l'utilisateur
                'role' => $role                                // Rôle attribué à l'utilisateur
            ];
        } else {
            // Si la liaison échoue
            $_SESSION['error'] = "Échec de l'authentification : mot de passe incorrect.";
        }

        // Déconnexion du serveur LDAP
        ldap_unbind($ldapConnection);
        return false;
    }
}
