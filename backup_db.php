<?php

$cone = new mysqli("localhost", "root", "", "db_condominios");
$backup_file = "backup_db_" . date("Y-m-d_H-i-s") . ".sql";

$tables = [];
$result = $cone->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

$sqlScript = "";
foreach ($tables as $table) {
    $result = $cone->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $sqlScript .= "INSERT INTO $table VALUES(";
        foreach ($row as $value) {
            $sqlScript .= "'" . $cone->real_escape_string($value) . "', ";
        }
        $sqlScript = rtrim($sqlScript, ", ") . ");\n";
    }
}

file_put_contents($backup_file, $sqlScript);
echo json_encode(["success" => "Respaldo de la base de datos realizado con éxito: $backup_file"]);

?>
