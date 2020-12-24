<?php
/**
 * @var System\Player[] $players
 * @var System\Player $newPlayer
 */
?>
<p>Beste <?= $newPlayer->name; ?>,</p>
<p>Voor jouw ingezonden aanmelding zijn 1 of meerdere gevonden die matchen met jouw beschikbare tijdsrange en overlap in opgegeven gebied op de kaart!</p>
<p>Hieronder de gegevens van de marker(s) (jouw gegevens zijn ook verstuurd naar deze marker(s)), veel plezier met contacten en succes op de baan!</p>
<?php foreach ($players as $player): ?>
    <ul>
        <li>Naam: <?= $player->name; ?></li>
        <li>E-mail: <?= $player->email; ?></li>
        <li>Handicap: <?= $player->handicap; ?></li>
        <li>Ingevoerde datum/tijd: <?= (date("d-m-Y H:i", $player->date_time)); ?></li>
    </ul>
<?php endforeach; ?>
<p>Met vriendelijke groet, <br/>Team Golf Marker</p>
