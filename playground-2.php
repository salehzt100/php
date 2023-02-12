<?php

/**
 * System
 * Validations Emails
    * Gmail() // sara.j@gmail.com
    * Outlook() // @outlook.com
    * Ptuk() // @putk.com
    * Harri() // @harri.com
 * Email
    * Enterprise
    * Educations
    * Government
 */

class EmailLevels {

    CONST ENTERPRISE_EMAIL = 1;
    CONST EDUCATION_EMAIL = 2;
    CONST GOVERNMENT_EMAIL = 3;
}

trait validateEmailVibes {

    public function validateEmail($email)
    {
        $parts = explode('@', $email);

        if (sizeof($parts) != 2) {

            throw new Exception("the `{$this->enterprise}` email isn't valid. the email should has one of `@`");
        }

        $username = $parts[0];
        $domain = $parts[1];

        if ($this instanceof ValidateUsername) {
            $this->validateUsername($username);
        }

        if ($domain != $this->domain) {

            throw new Exception("{$this->enterprise} email should ended with `@{$this->domain}`");
        }
    }
}

interface ValidateUsername {
    public function validateUsername($username);
}

abstract class Email {

    protected $domain;
    protected $enterprise;
    protected $level;

    protected function __construct($domain, $enterprise, $level) {
        $this->domain = $domain;
        $this->enterprise = $enterprise;
        $this->level = $level;
    }

    public abstract function validateEmail($email);
}

class Gmail extends Email implements ValidateUsername {
    use validateEmailVibes;

    public function __construct()
    {
        parent::__construct("gmail.com", "Google", EmailLevels::ENTERPRISE_EMAIL);
    }

    public function validateUsername($username)
    {
        if (strlen($username) < 4) {

            throw new Exception("Length should be more than 4 characters");
        }
    }

}

class Outlook extends Email implements ValidateUsername {
    use validateEmailVibes;

    public function __construct()
    {
        parent::__construct("outlook.com", "Microsoft", EmailLevels::ENTERPRISE_EMAIL);
    }

    public function validateUsername($username)
    {
        if (strlen($username) < 3) {

            throw new Exception("Length of Microsoft username should be more than 3 chars");
        }
    }
}

class Ptuk extends Email {
    use validateEmailVibes;

    public function __construct()
    {
        parent::__construct("ptuk.com", "Palestine Technical University Kadoorie", EmailLevels::EDUCATION_EMAIL);
    }
}

$sara_gmail = new Gmail();
try {
    $sara_gmail->validateEmail("sara.jarrar@gmail.com");
    echo "Sara email is valid!", "\n";
} catch (Exception $e) {
    echo "[EXP] " . $e->getMessage(), "\n";
}

$fadi_ptuk = new Outlook();
try {
    $fadi_ptuk->validateEmail("fadi.hijazi@harri.com");
    echo "Fadi email is valid!", "\n";
} catch (Exception $e) {
    echo "[EXP] " . $e->getMessage(), "\n";
}





