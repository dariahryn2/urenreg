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
    $bestand_bestaat = file_exists($bestand);

    $bestand_openen = fopen($bestand, 'a');

    if (!$bestand_bestaat) {
        fputcsv($bestand_openen, ['Naam', 'Project', 'Datum', 'Aantal Uren']);
    }

    fputcsv($bestand_openen, $gegevens);

    fclose($bestand_openen);
}

function main() {
    echo "Welkom bij het urenregistratiesysteem!\n";

    while (true) {
        $gegevens = vraag_gegevens();

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

