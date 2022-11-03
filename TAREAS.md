# TAREAS

## 2022-11-03

- [X] Bug con `inven/add_product.php`: Se modific'o la Base de Datos (`DataBase/prosalco.sql`), redefiniendo y/o eliminando campos apropiadamente.
    - Se eliminaron los campos `Nombre` y `Estado`, en la tabla `` `producto` ``. Se redefini'o `Imagen` a entero (id de imagen).
    - Redefinir la consulta en `add_product`: lineas 36 a 47.
