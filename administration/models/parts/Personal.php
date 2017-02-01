<?php

namespace administration\models\parts;

use PDO;

/**
 * Class Personal
 * @package administration\models\parts
 */
class Personal extends \application\models\parts\Personal
{
    /**
     * @param int $personId
     * @param array $data
     * @return bool
     */
        public function updatePersonalInfo($personId, array $data)
    {
        if(!empty($personId)) {
            $query = $this->getConnection()->prepare('
            UPDATE
                `personal` 
            SET
                `name` = :name, 
                `photo` = :photo, 
                `position` = :position,
                `about` = :about
            WHERE
                `id` = :personId
                ');
        } else {
            $query = $this->getConnection()->prepare('
            INSERT INTO `personal` (`name`,`photo`,`position`,`about`) VALUES (:name,:photo,:position,:about)');
        }

        $query->bindParam(':name', $data['name']);
        $query->bindParam(':photo', $data['photo']);
        $query->bindParam(':position', $data['position']);
        $query->bindParam(':about', $data['about']);
        
        if(!empty($personId)) {
            $query->bindParam(':personId', $personId, PDO::PARAM_INT);
        }

        return $query->execute();
    }
}
