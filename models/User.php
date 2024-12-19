<?php
require_once __DIR__ . '/../config/Modele.php';

class AuthModele {

    private $ldapHost = 'ldap://192.168.100.2';
    private $ldapPort = 389;
    private $ldapBaseDn = 'DC=hopital,DC=lan';

    public function verifierUtilisateurLDAP($username, $motDePasse) {
        $ldapConnection = ldap_connect($this->ldapHost, $this->ldapPort);

        if (!$ldapConnection) {
            return false;
        }

        ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapConnection, LDAP_OPT_REFERRALS, 0);

        $ldapBind = @ldap_bind($ldapConnection, $username . "@hopital.lan", $motDePasse);

        if (!$ldapBind) {
            $_SESSION['error'] = "Échec de l'authentification : mot de passe incorrect.";
            ldap_close($ldapConnection);
            return false;
        }

        $searchFilter = "(AccountName=$username)";
        $searchResult = @ldap_search($ldapConnection, $this->ldapBaseDn, $searchFilter);

        if (!$searchResult) {
            $_SESSION['error'] = "Erreur LDAP lors de la recherche : " . ldap_error($ldapConnection);
            ldap_close($ldapConnection);
            return false;
        }

        $entries = ldap_get_entries($ldapConnection, $searchResult);

        if ($entries['count'] === 0) {
            $_SESSION['error'] = "Utilisateur non trouvé dans le répertoire LDAP.";
            ldap_close($ldapConnection);
            return false;
        }

        $userDn = $entries[0]['dn'];

        if (@ldap_bind($ldapConnection, $userDn, $motDePasse)) {
            $role = 'user';
            $memberOf = $entries[0]['memberof'] ?? [];

        //if (is_array($memberOf) && in_array('CN=GG_ADMIN,OU=GG,OU=Groups,DC=hopital,DC=lan', $memberOf)) {
        //     $role = 'admin';
        // }

            ldap_unbind($ldapConnection);

            return [
                'nom' => $entries[0]['sn'][0] ?? '',
                'prenom' => $entries[0]['givenname'][0] ?? '',
                'email' => $entries[0]['mail'][0] ?? '',
                'role' => $role
            ];
        } else {
            $_SESSION['error'] = "Échec de l'authentification : mot de passe incorrect.";
        }

        ldap_unbind($ldapConnection);
        return false;
    }
}