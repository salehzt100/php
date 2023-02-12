<?php

/**
 * Abstract as concept, is abstract some container (like method or class) from `implementation`,
 * `implementation` means the code that build some logic.
 * So always the implementation can be inside `method` or `class` (define variables, storing data, arithmetic operators, ..etc.),
 * then when i define some method without implementation (just name & arguments) then we call it as `Abstract method`.
 *
 * Any `Class` contains at least one `Abstract method` should be defined as `Abstract class`
 * & `Abstract class` we can't create objects of.
 *
 * `Interface` is fully abstraction level, since we can only define `Abstract methods` &  `Constants`,
 * & a class can implement (inherit) many interfaces & each interface force the class to override his `Abstract methods`
 */

abstract class Email {
    protected $enterprise;
    protected $domain;
    protected $level;

    public abstract function validateEmail($email);
}

interface UsernameValidator {

    public function validateUserName($username);
}

class EmailLevels {

    const ENTERPRISE_EMAIL = 1;
    const EDUCATION_EMAIL = 2;
    const GOVERNMENT_EMAIL = 3;
}

class Gmail extends Email implements UsernameValidator {

    public function __construct()
    {
        $this->enterprise = "Gmail";
        $this->domain = "gmail.com";
        $this->level = EmailLevels::ENTERPRISE_EMAIL;
    }

    public function validateEmail($email)
    {
        $parts = explode('@', $email);

        if (sizeof($parts) != 2) {
            throw new Exception("the `{$email}` email isn't valid. the email should has one of `@` (no more no less)");
        }

        $username = $parts[0];
        $domain = $parts[1];

        $this->validateUserName($username);

        if ($domain != $this->domain) {
            throw new Exception("Gmail email should ended with `{$this->domain}`");
        }
    }

    public function validateUserName($username)
    {
        $username_length = strlen($username);

        if ($username_length < 5 || $username_length > 30) {
            throw new Exception("Username should be at least of 5 charachter & at maximum 10 characters.");
        }
    }
}

class Ptuk extends Email {

    public function __construct()
    {
        $this->enterprise = "Palestine Technical University Kadoorie";
        $this->domain = "ptuk.ps";
        $this->level = EmailLevels::EDUCATION_EMAIL;
    }

    public function validateEmail($email)
    {
        $parts = explode('@', $email);

        if (sizeof($parts) != 2) {
            throw new Exception("the `{$email}` email isn't valid. the email should has one of `@` (no more no less)");
        }

        $username = $parts[0];
        $domain = $parts[1];

        if ($domain != $this->domain) {
            throw new Exception("Ptuk email should ended with `{$this->domain}`");
        }
    }
}

// $email = new Email(); (BUG: you can't create object from Email)

try {
    $myEmail = "fadi.hijazi@gmail.com";

    $gmail_email = new Gmail();
    $gmail_email->validateEmail($myEmail);
    echo "GmailEmail Validation Passed.", "\n";

} catch (Exception $e) {

    $message = $e->getMessage();
    echo "[Exp]: {$message}";
}

try {
    $myEmail = "fadi@ptuk.ps";

    $ptuk_email = new Ptuk();
    $ptuk_email->validateEmail($myEmail);
    echo "PtukEmail Validation Passed.", "\n";

} catch (Exception $e) {

    $message = $e->getMessage();
    echo "[Exp]: {$message}";
}