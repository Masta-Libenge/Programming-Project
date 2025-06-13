<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validatieberichten (standaardregels)
    |--------------------------------------------------------------------------
    |
    | Deze berichten worden gebruikt door Laravel's validator voor standaard
    | validatieregels. Je kunt deze tekst aanpassen om gebruikersfeedback
    | vriendelijker en beter leesbaar te maken in het Nederlands.
    |
    */

    'accepted' => 'Je moet het veld :attribute accepteren.',
    'accepted_if' => 'Je moet het veld :attribute accepteren als :other gelijk is aan :value.',
    'active_url' => ':attribute moet een geldige URL zijn.',
    'after' => ':attribute moet een datum zijn na :date.',
    'after_or_equal' => ':attribute moet een datum zijn op of na :date.',
    'alpha' => ':attribute mag alleen letters bevatten.',
    'alpha_dash' => ':attribute mag alleen letters, cijfers, koppeltekens en underscores bevatten.',
    'alpha_num' => ':attribute mag alleen letters en cijfers bevatten.',
    'array' => ':attribute moet een lijst zijn.',
    'before' => ':attribute moet een datum zijn vóór :date.',
    'before_or_equal' => ':attribute moet een datum zijn op of vóór :date.',

    'between' => [
        'numeric' => ':attribute moet tussen :min en :max liggen.',
        'file' => ':attribute moet tussen :min en :max kilobytes zijn.',
        'string' => ':attribute moet tussen :min en :max tekens bevatten.',
        'array' => ':attribute moet tussen :min en :max items bevatten.',
    ],

    'boolean' => ':attribute moet waar of onwaar zijn.',
    'confirmed' => 'Herhaalwachtwoord komt niet overeen met het opgegeven wachtwoord.',
    'current_password' => 'Het huidige wachtwoord is onjuist.',
    'date' => ':attribute moet een geldige datum zijn.',
    'date_equals' => ':attribute moet gelijk zijn aan :date.',
    'date_format' => ':attribute moet het formaat :format volgen.',
    'different' => ':attribute en :other moeten verschillend zijn.',
    'digits' => ':attribute moet uit :digits cijfers bestaan.',
    'digits_between' => ':attribute moet tussen :min en :max cijfers bevatten.',
    'email' => ':attribute moet een geldig e-mailadres zijn.',
    'exists' => 'Geselecteerde :attribute is ongeldig.',
    'file' => ':attribute moet een bestand zijn.',
    'filled' => ':attribute moet ingevuld zijn.',

    'gt' => [
        'numeric' => ':attribute moet groter zijn dan :value.',
        'file' => ':attribute moet groter zijn dan :value kilobytes.',
        'string' => ':attribute moet meer dan :value tekens bevatten.',
        'array' => ':attribute moet meer dan :value items bevatten.',
    ],

    'gte' => [
        'numeric' => ':attribute moet groter dan of gelijk zijn aan :value.',
        'file' => ':attribute moet minimaal :value kilobytes zijn.',
        'string' => ':attribute moet minimaal :value tekens bevatten.',
        'array' => ':attribute moet :value of meer items bevatten.',
    ],

    'image' => ':attribute moet een afbeelding zijn.',
    'in' => 'Geselecteerde waarde voor :attribute is ongeldig.',
    'integer' => ':attribute moet een geheel getal zijn.',
    'ip' => ':attribute moet een geldig IP-adres zijn.',
    'ipv4' => ':attribute moet een geldig IPv4-adres zijn.',
    'ipv6' => ':attribute moet een geldig IPv6-adres zijn.',
    'json' => ':attribute moet een geldige JSON-string zijn.',

    'max' => [
        'numeric' => ':attribute mag niet groter zijn dan :max.',
        'file' => ':attribute mag niet groter zijn dan :max kilobytes.',
        'string' => ':attribute mag niet meer dan :max tekens bevatten.',
        'array' => ':attribute mag niet meer dan :max items bevatten.',
    ],

    'min' => [
        'numeric' => ':attribute moet minimaal :min zijn.',
        'file' => ':attribute moet minimaal :min kilobytes zijn.',
        'string' => ':attribute moet minimaal :min tekens bevatten.',
        'array' => ':attribute moet minimaal :min items bevatten.',
    ],

    'not_in' => 'De geselecteerde :attribute is ongeldig.',
    'numeric' => ':attribute moet een getal zijn.',
    'required' => ':attribute is verplicht.',
    'same' => ':attribute en :other moeten overeenkomen.',

    'size' => [
        'numeric' => ':attribute moet :size zijn.',
        'file' => ':attribute moet :size kilobytes zijn.',
        'string' => ':attribute moet :size tekens bevatten.',
        'array' => ':attribute moet :size items bevatten.',
    ],

    'string' => ':attribute moet een tekst zijn.',
    'unique' => ':attribute is al in gebruik.',
    'url' => ':attribute moet een geldige URL zijn.',
    'uuid' => ':attribute moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Aangepaste validatieberichten
    |--------------------------------------------------------------------------
    |
    | Hier kun je voor specifieke attributen en regels aangepaste meldingen
    | definiëren, bijvoorbeeld: 'email.required' => 'E-mailadres is verplicht'.
    |
    */

    'custom' => [
        'email' => [
            'required' => 'We hebben je e-mailadres nodig.',
            'email' => 'Gebruik een geldig e-mailadres.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Aangepaste veldnamen
    |--------------------------------------------------------------------------
    |
    | Hier kun je Engelse veldnamen vervangen door meer leesbare namen.
    | Bijvoorbeeld: 'email' => 'e-mailadres'
    |
    */

    'attributes' => [
        'name' => 'naam',
        'email' => 'e-mailadres',
        'password' => 'wachtwoord',
        'password_confirmation' => 'herhaalwachtwoord',
    ],

];
