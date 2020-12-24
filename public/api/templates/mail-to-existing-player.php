<?php
/**
 * @var System\Player $player
 * @var System\Player $newPlayer
 */
?>
<p>Beste <?= $player->name; ?>,</p>
<p>Via een zojuist ingezonden aanmelding is een marker gevonden die matched met jouw beschikbare tijdsrange en overlap in opgegeven gebied op de kaart!</p>
<p>Hieronder de gegevens van de marker (jouw gegevens zijn ook verstuurd naar deze marker), veel plezier met contacten en succes op de baan!</p>
<ul>
    <li>Naam: <?= $newPlayer->name; ?></li>
    <li>E-mail: <?= $newPlayer->email; ?></li>
    <li>Handicap: <?= $newPlayer->handicap; ?></li>
    <li>Ingevoerde datum/tijd: <?= (date("d-m-Y H:i", $newPlayer->date_time)); ?></li>
</ul>
<p>Met vriendelijke groet, <br/>Team Golf Marker</p>
