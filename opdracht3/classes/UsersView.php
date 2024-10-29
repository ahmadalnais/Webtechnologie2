<?php

declare(strict_types=1);

class UsersView extends Users
{
    public function showUser($naam): void
    {
        $user = $this->getUser($naam);
        if ($user) {
            print_r("Naam: " . $user['name'] . PHP_EOL);
        } else {
            print_r("Er zijn geen gebruiker gevonden.");
        }
    }
}
