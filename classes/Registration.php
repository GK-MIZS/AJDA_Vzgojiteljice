<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Uporabniško ime ne sme biti prazno";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Geslo ne sme biti prazno";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Gesli se ne ujemata";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Geslo mora vsebovati vsaj 6 znakov";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Uporabniško ime mora biti dolgo med 2 in 64 znaki";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Uporabniško ime lahko vsebuje le črke (a-Z) in številke, dolžine od 2 do 64 znakov";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "E-poštni naslov ne sme biti prazen";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "E-poštni naslov ne sme biti daljši od 64 znakov";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "E-poštni naslov ni v veljavni obliki";        
        } elseif (
            !empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name         = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email        = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $ime               = $this->db_connection->real_escape_string(strip_tags($_POST['ime'], ENT_QUOTES));
                $priimek           = $this->db_connection->real_escape_string(strip_tags($_POST['priimek'], ENT_QUOTES));
                $naslov            = $this->db_connection->real_escape_string(strip_tags($_POST['naslov'], ENT_QUOTES));
                $posta             = $this->db_connection->real_escape_string(strip_tags($_POST['posta'], ENT_QUOTES));
                $posta_stevilka    = $this->db_connection->real_escape_string(strip_tags($_POST['posta_stevilka'], ENT_QUOTES));
                $skupina           = $this->db_connection->real_escape_string(strip_tags($_POST['skupina'], ENT_QUOTES));
                $tip_izgleda       = $this->db_connection->real_escape_string(strip_tags($_POST['tip_izgleda'], ENT_QUOTES));
                $nacin_placila     = $this->db_connection->real_escape_string(strip_tags($_POST['nacin_placila'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM AJDA_users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Ta e-poštni naslov je že zaseden.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO AJDA_users (
                        user_name, 
                        user_password_hash, 
                        user_email, 
                        ime, 
                        priimek, 
                        naslov, 
                        posta, 
                        posta_stevilka, 
                        skupina, 
                        tip_izgleda, 
                        nacin_placila
                    ) VALUES (
                        '" . $user_name . "', 
                        '" . $user_password_hash . "', 
                        '" . $user_email . "', 
                        '" . $ime . "', 
                        '" . $priimek . "', 
                        '" . $naslov . "', 
                        '" . $posta . "', 
                        '" . $posta_stevilka . "', 
                        '" . $skupina . "', 
                        '" . $tip_izgleda . "', 
                        '" . $nacin_placila . "'
                    );";

                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Vaš račun je bil uspešno ustvarjen. Zdaj se lahko prijavite.";
                    } else {
                        $this->errors[] = "Registracija ni uspela. Prosimo, poskusite znova.";
                    }
                }
            } else {
                $this->errors[] = "Povezava z bazo podatkov ni uspela.";
            }
        } else {
            $this->errors[] = "Prišlo je do neznane napake";
        }
    }
}
