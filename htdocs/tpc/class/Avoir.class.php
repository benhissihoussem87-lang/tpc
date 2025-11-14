<?php
include_once 'connexion.db.php';

class Avoir {
    private $cnx;
    public function __construct() { $this->cnx = connexion(); }

    public function getAll() {
        try {
            $sql = "SELECT a.*, c.nom_client \n                    FROM facture_avoir a \n                    JOIN clients c ON a.id_client = c.id \n                    ORDER BY a.date_avoir DESC, a.id DESC";
            $st = $this->cnx->query($sql);
            return $st->fetchAll();
        } catch (\PDOException $e) {
            // If table doesn't exist yet, return empty list gracefully
            $msg = $e->getMessage();
            if (strpos($msg, '42S02') !== false || stripos($msg, 'Base table or view not found') !== false) {
                return [];
            }
            throw $e;
        }
    }

    public function getById($id) {
        $sql = "SELECT a.*, c.nom_client, c.adresse, a.matriculeFiscale AS mf_avoir, c.matriculeFiscale AS mf_client \n                FROM facture_avoir a \n                JOIN clients c ON a.id_client = c.id \n                WHERE a.id = :id";
        $st = $this->cnx->prepare($sql);
        $st->execute([':id' => $id]);
        return $st->fetch();
    }

    public function create(array $data) {
        $params = [
            ':num_avoir' => $data['num_avoir'] ?? null,
            ':num_fact'  => $data['num_fact']  ?? null,
            ':id_client' => $data['id_client'],
            ':date_avoir'=> $data['date_avoir'],
            ':total_ht'  => $data['total_ht']  ?? 0,
            ':total_tva' => $data['total_tva'] ?? 0,
            ':total_ttc' => $data['total_ttc'] ?? 0,
            ':matriculeFiscale' => ($data['matriculeFiscale'] ?? null),
        ];
        $sql = "INSERT INTO facture_avoir
                (num_avoir, num_fact, id_client, date_avoir, total_ht, total_tva, total_ttc, matriculeFiscale)
                VALUES (:num_avoir, :num_fact, :id_client, :date_avoir, :total_ht, :total_tva, :total_ttc, :matriculeFiscale)";
        try {
            $st = $this->cnx->prepare($sql);
            return $st->execute($params);
        } catch (\PDOException $e) {
            $msg = $e->getMessage();
            if (strpos($msg, '42S02') !== false || stripos($msg, 'Base table or view not found') !== false) {
                // Bootstrap schema if the table is missing, then retry once
                $this->bootstrapSchema();
                $st = $this->cnx->prepare($sql);
                return $st->execute($params);
            }
            throw $e;
        }
    }

    private function bootstrapSchema(): void {
        $ddl = <<<SQL
CREATE TABLE IF NOT EXISTS `facture_avoir` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `num_avoir` VARCHAR(32) NOT NULL,
  `num_fact` VARCHAR(32) NULL,
  `id_client` INT NOT NULL,
  `date_avoir` DATE NOT NULL,
  `total_ht` DECIMAL(12,3) NOT NULL DEFAULT 0,
  `total_tva` DECIMAL(12,3) NOT NULL DEFAULT 0,
  `total_ttc` DECIMAL(12,3) NOT NULL DEFAULT 0,
  `matriculeFiscale` VARCHAR(64) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_num_avoir` (`num_avoir`),
  KEY `idx_num_fact` (`num_fact`),
  KEY `idx_id_client` (`id_client`),
  CONSTRAINT `fk_facture_avoir_client`
    FOREIGN KEY (`id_client`) REFERENCES `clients`(`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_facture_avoir_facture`
    FOREIGN KEY (`num_fact`) REFERENCES `facture`(`num_fact`)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
SQL;
        $this->cnx->exec($ddl);
    }

    public function delete($id) {
        $st = $this->cnx->prepare("DELETE FROM facture_avoir WHERE id = :id");
        return $st->execute([':id' => $id]);
    }

    public function update(int $id, array $data) {
        $sql = "UPDATE facture_avoir SET
                  num_avoir = :num_avoir,
                  num_fact = :num_fact,
                  id_client = :id_client,
                  date_avoir = :date_avoir,
                  total_ht = :total_ht,
                  total_tva = :total_tva,
                  total_ttc = :total_ttc,
                  matriculeFiscale = :matriculeFiscale
                WHERE id = :id";
        $st = $this->cnx->prepare($sql);
        return $st->execute([
            ':num_avoir' => $data['num_avoir'],
            ':num_fact'  => ($data['num_fact'] ?? null),
            ':id_client' => $data['id_client'],
            ':date_avoir'=> $data['date_avoir'],
            ':total_ht'  => $data['total_ht'],
            ':total_tva' => $data['total_tva'],
            ':total_ttc' => $data['total_ttc'],
            ':matriculeFiscale' => ($data['matriculeFiscale'] ?? null),
            ':id' => $id,
        ]);
    }

    public function nextNumber(?int $year = null): string {
        $year4 = (string)($year ?? (int)date('Y'));
        $year2 = substr($year4, -2);
        try {
            $st = $this->cnx->prepare(
                "SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(num_avoir,'/',1) AS UNSIGNED)),0)
                 FROM facture_avoir WHERE num_avoir LIKE :sfx2 OR num_avoir LIKE :sfx4"
            );
            $st->execute([':sfx2' => '%/'.$year2, ':sfx4' => '%/'.$year4]);
            $seq = ((int)$st->fetchColumn()) + 1;
        } catch (\PDOException $e) {
            // If table is missing, default to first sequence for current year
            $msg = $e->getMessage();
            if (strpos($msg, '42S02') !== false || stripos($msg, 'Base table or view not found') !== false) {
                $seq = 1;
            } else {
                throw $e;
            }
        }
        return sprintf('%02d/%s', $seq, $year2);
    }
}

$avoir = new Avoir();

?>
