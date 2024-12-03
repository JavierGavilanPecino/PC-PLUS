### Tienda PcPlus
# 1- Funcionamiento general
En primer lugar, nos encontramos con login.php, en el cual introduciremos las credenciales (cliente y contraseña) para poder entrar en nuestra cuenta.
También tenemos el botón de “crear cuenta”, en el que, introduciendo la clave de administrador “root”, podremos crear nuevas cuentas que quedarán guardadas en nuestra base de datos.

Una vez introducimos correctamente las credenciales, accederemos a categoria.php, donde tendremos las distintas categorías de los productos que tenemos para poder pedir con el cliente con el que iniciamos sesión.

Arriba, una característica que comparten en las distintas pantallas son los botones que muestran nuestro usuario, pedidos, cerrar sesión y carrito.

Una vez hacemos clic en ver productos de cualquier categoría, accederemos a producto.php, donde podremos ver los diferentes productos que tenemos en dicha categoría.

Podemos ver cada producto, con su stock y un campo de texto donde introducir la cantidad que queremos añadir al carrito.

Una vez tengamos la cantidad deseada de los productos, haremos clic en añadir al carrito, que nos llevará a carrito.php.

En carrito.php, veremos los productos elegidos anteriormente en carrito, los cuales tienen a su derecha un botón para borrarlos del carrito por si, finalmente, no vamos a pedirlo o, el botón cancelar que nos borraría todo el carrito.

Una vez hacemos clic en hacer pedido, nos llevará a pedidos.php, donde veremos todos los pedidos realizados con la cuenta que hemos entrado.

En cada pedido disponemos del número de pedido, su fecha y un botón de info del pedido (el cual nos lleva a infopedido.php), en el que podremos visualizar los productos y su cantidad pedida.

## Base de datos

La base de datos consiste en 5 tablas que son clientes,pedidos,categorías, productos y pedidos_productos

- **Clientes** consiste en su clave primaria CodCliente, Correo y Clave.

- **Pedido** consiste en CodPed que es su clave primaria, CodCliente que es clave foránea que viene de la tabla cliente y Fecha.

- **Categoría** está formada por CodCat que es clave primaria y NombreCat.

- **Producto** está formada por CodProd que es  clave primaria, CodCat que es clave foránea que viene de la tabla Categoria, NombreProd y Stock

- **Pedido_Producto** se forma por la relación N:N de Pedido y Producto. Esta tabla se crea para representar eficientemente la relación entre estas tablas. Pedido_Producto está conformada por una id que es su clave primaria, CodPed y CodProd que son claves foráneas de sus respectivas tablas y unidades.

## Archivos
- **Login.php** -> Aquí tenemos el funcionamiento de la pantalla para poder acceder al cliente correspondiente. Si ponemos credenciales incorrectas, nos dará error de usuario o contraseña, para que el usuario revise si los ha puesto mal e intentar volver a acceder.
En el caso de hacer clic en crear cuenta será redirigido a crearcuenta.php.
En el caso de hacer clic en iniciar sesión, será redirigido a categoria.php

- **Crearcuenta.php** -> Introducimos el usuario del nuevo cliente y su contraseña y, en caso de no estar repetido y poner bien la clave de administrador (root), se creará una nueva cuenta que estará guardada en pedidos.sql.

- **Categoria.php** -> Pantalla que muestra las categorías de productos que, dependiendo a cual se hace clic, cargará un $_POST con el número de categoría correspondiente para que producto.php muestre la categoría correspondiente.

- **Producto.php** -> Pantalla para poder seleccionar la cantidad y que productos añadir al carrito. Si nos pasamos de cantidad respecto al stock disponible, no se podrá añadir y nos dará un error por pasarnos del stock disponible.

- **Carrito.php** -> Pantalla con los distintos productos añadidos. Se pueden borrar uno por uno, borrar todo el carrito o pedir los productos mostrados.
(Al añadir productos al carrito, la cantidad se shopará del stock disponible)

- **Pedidos.php** -> Pantalla que muestra todos los pedidos realizados, con la posibilidad de ver que incluye cada pedido.

- **Infopedido.php** -> Pantalla que muestra los detalles del pedido consultado, con los productos y su cantidad.

- **Logout.php** -> Cerraremos la sesión actual, eliminando la cookie que contiene dicha sesión y volveremos a login.php

- **Tienda.php** -> Nos encontraremos la clase cliente, el cual contiene métodos para el funcionamiento correcto de las distintas páginas web como validadores y consultas en la base de datos. Además también existen diferentes test para comprobar el correcto funcionamiento de las funciones.

- **Pedidos.sql** -> Este archivo contiene las sentencias sql para crear la base de datos, además de introducir los datos.

- **Style.css** -> Archivos que contiene los distintos parámetros y efectos visuales de las distintas pantallas.

## Métodos de clase cliente
- **__construct**: Realiza la conexion a la base de datos mediante PDO y en caso de que no exista, la crea mediante el archivo pedidos.sql.

- **__destruct**: Destruye la conexión a la base de datos.

- **ejecuta_SQL($sql)**: Le introduces una sentencia sql y te devuelve el resultado si se pudo realizar la sentencia. Si no te devuelve false.

- **Comprobarcreado($nombre)**: Introduces el nombre de un cliente y te devuelve la id si existe o te devuelve 0 si no existe.

- **comprobar_usuario($nombre,$contras)**: Introduces el nombre de un cliente y su clave, y si coinciden en la base de datos, devuelve la id del cliente. en caso contrario devuelve 0;

- **getCategorias()**: Devuelve un array con la lista de toda la información de todas las categorías (tabla categoría).

- **getProductos($id_cat)**: Introduces la id de la categoría y te devuelve un array con todos los productos que contengan la id correspondiente.

- **getNombrecliente($id_shop)**: Introduces la id de un cliente y te devuelve su nombre.

- **comprobarStock($array)**: Le das un array con los productos de la cesta que vas a introducir en el carrito (array bidimensional, [0] contiene la id del producto y [1] las unidades que quieres coger). Comprobará si hay stock de todos los productos y por cada producto que no haya stock, lo guardará en un array de errores con los nombres de todos los que no hay stock suficiente. Devolverá el array $errores sin importar si está vacío o con elementos.

- **addCarrito($cesta,$carrito)**: Proporcionas el array de carrito y otro array con los productos a introducir al carrito. Te devuelve el carrito actualizado con los nuevos datos introducidos además de actualizar el stock en la base de datos. 

- **borrarCarrito($carrito)**: Introduces un array con el carrito. Actualizará el stock en la base de datos y devolverá el array vacío.

- **ImprimirCarrito($carrito)**: Proporcionas un array con el carrito e imprime todos los datos en una tabla.

- **delProductoCarrito($carrito,$id_del)**: Introduces el array con el carrito y la id del producto a eliminar. Devuelve el carrito actualizado.

- **Crearusuario($nombre,$clave)**: Proporcionas un nombre y una contraseña y la crea en la base de datos.

- **ConfirmarPedido($carrito,$id_cliente)**: Proporcionas el array que contiene los productos en el carrito y inserta en la tabla pedidos el Id_shop y la fecha que se hace el carrito aparte también inserta en la tabla pedidos_productos el CodPed del pedido recien realizado, los códigos de los productos del carrito añadidos y sus unidades.

- **ImprimirPedidos($id_shop)**: Proporcionas el id del cliente y busca en la tabla de pedidos todos en los que el Codres coincida con el ID del cliente y los enseña por pantalla.

- **ImprimirDatosPedidos($Codpedido)**: Introduces el código de un pedido y mostrará todos los productos del pedido con su cantidad pertenecientes al pedido seleccionado. Será mostrado a través de una tabla.

## $_POST
- **$_POST[“correo”]**: obtiene el correo introducido en el formulario de login.php
  
- **$_POST[‘clave’]**: obtiene la contraseña introducida en el formulario de login.php
  
- **$_POST['iniciar']**: usado para identificar cuando se le da al botón iniciar en login.php
  
- **$_POST[‘claveAd’]**: obtiene la clave del administrador introducida a la hora de crear la cuenta
  
- **$_POST[‘cat’]**: Obtiene la categoría seleccionada en el formulario de categoria.php y lo envía a producto.php para que muestre solo aquellos productos que coincidan.
  
- **$_POST[‘addCarrito’]**: Cuando se le da al botón del formulario en producto.php de añadir productos al carrito, lo detecta teniendo como valor 1, sólo interesa si existe o no
  
- **$_POST[‘cantidad$i’]**: Cada producto del formulario en productos.php tendrá una variable definida como cantidad siendo $i 1, 2, etc hasta el número total de productos detectando la cantidad de ese producto que se introduce.
  
- **$_POST[‘producto$i’]**: Cada producto del formulario en productos.php tendrá una variable definida como cantidad siendo $i 1, 2, etc hasta el número total de productos detectando la id del producto que se introduce.
  
- **$_POST[‘cancelar']**: Es un botón que llama al método borrarCarrito() que vacía el array del carrito dejándolo vacío en carrito.php.
  
- **$_POST[‘DelProducto’]**: Es un botón que llama al metodo delProductoCarrito que borra del carrito el producto seleccionado en el formulario en carrito.php.
  
- **$_POST[‘aceptar_pedido’]**: Botón pulsado en el formulario de carrito.php para realizar el pedido con los productos existentes en el carrito en pedidos.php.
  
- **$_POST[‘'Codped']**: (pedidos.php e infopedido.php) Obtiene el pedido seleccionado en pedidos.php y lo envía a infopedido.php para mostrar los productos en ese pedido con el método ImprimirDatosPedidos().

## $_SESSION
En todos los archivos hay un session_start() que recoge todas las variables de sesión
- **$_SESSION[‘id_cliente’]**: guarda el id del cliente actual
  
- **$_SESSION[‘cat’]**: guarda el id de la categoría que se ha elegido
  
- **$_SESSION[‘cesta’]**: guarda el id de los productos que se han añadido, además de la cantidad introducida en un array bidimensional en el que [0] es la id del producto y [1] la cantidad elegida del mismo
  
- **$_SESSION[carrito]**: guarda los productos junto a la cantidad de cada uno que había en la cesta en el carrito
