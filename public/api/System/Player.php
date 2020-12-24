<?php namespace System;

/**
 * Class Player
 * @package System
 */
class Player
{
    public ?int $id = null;
    public string $name;
    public string $email;
    public int $date_time;
    public int $handicap;
    public int $km_range;
    public float $lng;
    public float $lat;

    /**
     * @param Player $player
     * @return Player[]
     * @throws \Exception
     * @see https://ourcodeworld.com/articles/read/1019/how-to-find-nearest-locations-from-a-collection-of-coordinates-latitude-and-longitude-with-php-mysql
     */
    public static function getPlayersByLocationRange(Player $player): array
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM (
                                SELECT *, 
                                    (
                                        (
                                            (
                                                acos(
                                                    sin(( :lat * pi() / 180))
                                                    *
                                                    sin(( `lat` * pi() / 180)) + cos(( :lat * pi() /180 ))
                                                    *
                                                    cos(( `lat` * pi() / 180)) * cos((( :lng - `lng`) * pi()/180)))
                                            ) * 180/pi()
                                        ) * 60 * 1.1515 * 1.609344 - `km_range`
                                    )
                                as distance FROM `players`
                            ) AS p
                            WHERE distance <= :km_range
                            AND p.date_time BETWEEN :time_start AND :time_end
                            AND p.email != :email");

        $statement->execute([
            ":lng" => $player->lng,
            ":lat" => $player->lat,
            ":km_range" => $player->km_range,
            ":time_start" => $player->date_time - 3600,
            ":time_end" => $player->date_time + 3600,
            ":email" => $player->email
        ]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, "System\\Player");
    }

    /**
     * @param Player $player
     * @return bool
     * @throws \Exception
     */
    public static function add(Player $player): bool
    {
        $db = Database::getInstance();
        $statement = $db->prepare("INSERT INTO players
                                    (name, email, date_time, handicap, km_range, lng, lat)
                                    VALUES(:name, :email, :date_time, :handicap, :km_range, :lng, :lat)");
        return $statement->execute([
            ':name' => $player->name,
            ':email' => $player->email,
            ':date_time' => $player->date_time,
            ':handicap' => $player->handicap,
            ':km_range' => $player->km_range,
            ':lng' => $player->lng,
            ':lat' => $player->lat
        ]);
    }
}
