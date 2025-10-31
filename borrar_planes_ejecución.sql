Comandos para borrar los planes de ejecución de la base de datos

FLUSH TABLES;
FLUSH QUERY CACHE;
EXPLAIN SELECT ...
RESET QUERY CACHE;


-- Llamar al procedimiento:
CALL optimize_and_analyze_all('laravel_pliegos');