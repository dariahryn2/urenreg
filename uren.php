<?php

function vraag_gegevens() {
    echo "Naam: ";
    $naam = trim(fgets(STDIN));

    echo "Projectnaam: ";
    $project = trim(fgets(STDIN));

    echo "Datum (dd-mm-jjjj): ";
    $datum = trim(fgets(STDIN));

    echo "Aantal uren (hh:mm): ";
    $aantaluren = trim(fgets(STDIN));

    return [
        'naam' => $naam,
        'project' => $project,
        'datum' => $datum,
        'aantaluren' => $aantaluren
    ];
}

function sla_gegevens_op($bestand, $gegevens) {
    // Controleer of het bestand al bestaat, anders maak een nieuwe aan
    $bestand_bestaat = file_exists($bestand);

    // Open het bestand om gegevens toe te voegen
    $bestand_openen = fopen($bestand, 'a');

    // Schrijf de header als het bestand nieuw is
    if (!$bestand_bestaat) {
        fputcsv($bestand_openen, ['Naam', 'Project', 'Datum', 'Aantal Uren']);
    }

    // Schrijf de gegevens in het bestand
    fputcsv($bestand_openen, $gegevens);

    // Sluit het bestand
    fclose($bestand_openen);
}

function main() {
    echo "Welkom bij het urenregistratiesysteem!\n";

    while (true) {
        // Verzamel gegevens van de gebruiker
        $gegevens = vraag_gegevens();

        // Stop de loop als de gebruiker geen gegevens invoert
        if ($gegevens === null) {
            echo "\nBedankt! Het programma wordt afgesloten.\n";
            return;
        }

        if ($gegevens) {
            echo "\nDe ingevoerde gegevens:\n";
            echo "Naam: " . $gegevens['naam'] . "\n";
            echo "Project: " . $gegevens['project'] . "\n";
            echo "Datum: " . $gegevens['datum'] . "\n";
            echo "Aantal uren: " . $gegevens['aantaluren'] . "\n";

           sla_gegevens_op('urenregistratie.csv', $gegevens);
           echo "Gegevens zijn opgeslagen.\n\n";

        }
    }

    
}


// Start het programma
main();

