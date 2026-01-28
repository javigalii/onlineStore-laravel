<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use mysqli;
use Exception;

class ExportDatabase extends Command
{
    /**
     * El nombre y firma del comando en la consola.
     */
    protected $signature = 'db:export';

    /**
     * La descripción del comando.
     */
    protected $description = 'Genera un backup completo de la base de datos usando PHP Nativo';

    public function handle()
    {
        // 1. Preparar la ruta y la carpeta
        $path = storage_path('backups');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $filename = "backup_" . date('Y-m-d_H-i-s') . ".sql";
        $filePath = $path . '/' . $filename;

        // 2. Obtener credenciales del .env
        $host = env('DB_HOST', '127.0.0.1');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $name = env('DB_DATABASE');

        $this->info("Iniciando exportación de la base de datos: $name...");

        try {
            // 3. Conexión mediante MySQLi
            $mysqli = new mysqli($host, $user, $pass, $name);
            $mysqli->set_charset("utf8mb4");

            if ($mysqli->connect_error) {
                throw new Exception('Error de conexión: ' . $mysqli->connect_error);
            }

            // 4. Obtener listado de tablas
            $tables = [];
            $result = $mysqli->query('SHOW TABLES');
            while ($row = $result->fetch_row()) {
                $tables[] = $row[0];
            }

            $sql = "-- Backup Tech Store ⚡\n";
            $sql .= "-- Generado: " . date('Y-m-d H:i:s') . "\n";
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            // 5. Recorrer tablas y extraer estructura y datos
            foreach ($tables as $table) {
                $this->line("Exportando tabla: $table");

                // Estructura de la tabla
                $sql .= "DROP TABLE IF EXISTS `$table`;\n";
                $rowStructure = $mysqli->query("SHOW CREATE TABLE `$table`")->fetch_row();
                $sql .= $rowStructure[1] . ";\n\n";

                // Datos de la tabla
                $resultData = $mysqli->query("SELECT * FROM `$table`");
                $numFields = $resultData->field_count;

                while ($row = $resultData->fetch_row()) {
                    $sql .= "INSERT INTO `$table` VALUES(";
                    for ($j = 0; $j < $numFields; $j++) {
                        if (isset($row[$j])) {
                            // Escapar caracteres especiales
                            $value = $mysqli->real_escape_string($row[$j]);
                            $sql .= '"' . $value . '"';
                        } else {
                            $sql .= 'NULL';
                        }
                        if ($j < ($numFields - 1)) {
                            $sql .= ',';
                        }
                    }
                    $sql .= ");\n";
                }
                $sql .= "\n\n";
            }

            $sql .= "SET FOREIGN_KEY_CHECKS=1;";

            // 6. Guardar archivo físico
            file_put_contents($filePath, $sql);

            $this->info("--------------------------------------------------");
            $this->info("¡ÉXITO TOTAL! 🚀");
            $this->info("Archivo: storage/backups/$filename");
            $this->info("Tamaño: " . round(filesize($filePath) / 1024, 2) . " KB");
            $this->info("--------------------------------------------------");

        } catch (Exception $e) {
            $this->error("ERROR CRÍTICO: " . $e->getMessage());
        }
    }
}