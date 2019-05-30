<?php
namespace Camagru;

class Account {
    private $pdo;
    private $record = [];
    private $errors = [];

    public function __construct($pdo, $record = [], $errors = []) {
        $this->pdo = $pdo;
        $this->record = $record;
        $this->errors = $errors;
    }

    public function getRecord() {
        return $this->record;
    }

    public function getErrors() {
        return $this->errors;
    }
}