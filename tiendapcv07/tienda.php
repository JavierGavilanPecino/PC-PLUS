<?php
//Botón ficticio que devuelve un enlace html
function boton_ficticio($caption,$url)
{
    return "<TABLE border=1 CELLSPACING=0 CELLPADDING=3 bgcolor=black>
            <TR><TD bgcolor=\"white\">
                <FONT size =\"-1\">
                    <a href = \"$url\">$caption</A>
               </FONT>
             </TD></TR></TABLE>";
}

//Define las constantes para la conexión de la base de datos
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("CLAVE", "");

//Clase tienda
class tienda
{
    protected $db;

	
    function __construct($BD="") //Esto es el constructor
  	{  	  
	    /* Intentamos establecer una conexión con el servidor.*/
		try {
			if ($BD!='')
				$this->db = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . $BD .";charset=utf8", USUARIO, CLAVE, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			else 
				$this->db = new PDO("mysql:host=" . SERVIDOR. ";charset=utf8", USUARIO, CLAVE, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			
			$this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,  true);
			// Indicamos como atributo que se debe devolver una cadena vacía para los valores nulos
			$this->db->setAttribute(PDO::NULL_TO_STRING, true);
			// Si no indicamos la BD es que hay que crearla de nuevo
			if ($BD=='') {
				// Ejecutamos la SQL de Creación de BD directamente
			   // en el servidor MySQL.
			   /* Intentamos crear la base de datos "ejercicios".
				* Si se consigue hacerlo, se informa de ello.
			   * Si no, también se informa y se indica cuál es el
			   * motivo del fallo con el mensaje de error.*/
			   $sql = file_get_contents('pedidos.sql');			 
			   $this->ejecuta_SQL($sql);
			}
		} catch (PDOException $e) {
			die ("<p><H3>No se ha podido establecer la conexión.
				  <P>Compruebe si está activado el servidor de bases de 
				  datos MySQL.</H3></p>\n <p>Error: " . $e->getMessage() . "</p>\n");
		} // end try
	}//end function constructor

    function __destruct() //Esto es el destructor
	{
		if (isset($db)) // Desconectamos de la BD
			$db=null;
	}//end destructor agenda
		
	  

	//Función para ejecutar las consultas SQL
    function ejecuta_SQL($sql) {
		$resultado=$this->db->query($sql);
		//Si no obtiene el resultado, salta el error mediante el echoy muestra el fallo con print_r
		if (!$resultado)
		{
			echo"<H3>No se ha podido ejecutar la consulta: <PRE>$sql</PRE><P><U> Errores</U>: </H3><PRE>";
			print_r($this->db->errorInfo());					
			die ("</PRE>");
		}
		return $resultado;
	} // end ejecuta_SQL

	//Comprueba si existe el usuario introducido
	function Comprobarcreado($nombre){
		//ejecucion de sentencia sql que devuelve toda la informacion del tienda con el nombre
		$sql_script = "SELECT * FROM cliente WHERE Correo='$nombre'";
        $resultado=$this->ejecuta_SQL($sql_script);

		//si el resultado obtenido tiene 1 fila, significa que hay coincidencia
    	if($resultado->rowCount()>0)
		{
			//devolucion del codigo del tienda encontrado
			return $resultado->fetchAll(\PDO::FETCH_ASSOC)[0]['CodCliente'];
		}

        return 0;
	}

	//Comprueba que se ha introducido correctamente un usuario y su contraseña
    function comprobar_usuario($nombre,$contras)
    {
		//ejecucion de sentencia sql que devuelve toda la informacion del tienda con el nombre y la clave
        $sql_script = "SELECT * FROM cliente WHERE Correo='$nombre' AND Clave='$contras'";
        $resultado=$this->ejecuta_SQL($sql_script);

		//si el resultado obtenido tiene 1 fila, significa que hay coincidencia
    	if($resultado->rowCount()>0)
		{
			//devolucion del codigo del tienda encontrado
			return $resultado->fetchAll(\PDO::FETCH_ASSOC)[0]['CodCliente'];
		}

        return 0;
    }

	//Método para obtener las categorías
  function getCategorias()
	{
		//ejecución de sentencia sql que devuelve todos los datos de las categorías
		$sql_script = "SELECT * FROM categoria";
		$resultado=$this->ejecuta_SQL($sql_script);

		//devolucion de las categorias
		return $resultado->fetchAll(\PDO::FETCH_ASSOC);
	}

	//Método para obtener los productos de una categoría
	function getProductos($id_cat)
	{
		//ejecución de sentencia sql que devuelve todos los productos de una categoría
		$sql_script = "SELECT * FROM producto WHERE CodCat='$id_cat'";
		$resultado=$this->ejecuta_SQL($sql_script);

		//devolucion de todos los productos de la categoría seleccionada
		return $resultado->fetchAll(\PDO::FETCH_ASSOC);
	}

	//funcion para obtener el nombre del tienda
	function getNombreCliente($id_cliente)
	{
		//ejecución de sentencia sql que devuelve el nombre del tienda
		$sql_script = "SELECT Correo FROM cliente WHERE CodCliente='$id_cliente'";
		$resultado=$this->ejecuta_SQL($sql_script);

		//devolucion del nombre del tienda
		return $resultado->fetchAll(\PDO::FETCH_ASSOC)[0]['Correo'];
	}
	
	//funcion para comprobar el stock disponible
	function comprobarStock($array)
	{
		$errores = array();
		for($i=0;$i<sizeof($array);$i++)
		{
			$id_prod = $array[$i][0];//id del producto
			$n = $array[$i][1];//cantidad
			$sql_script = "SELECT * FROM producto WHERE CodProd='$id_prod'";
			$resultado=$this->ejecuta_SQL($sql_script);

			if($resultado->rowCount()>0)
			{
				$item = $resultado->fetchAll(\PDO::FETCH_ASSOC)[0];

				if ($item['Stock']<$n || $n<0)
				{
					array_push($errores,$item['NombreProd']);
				}
			}
		}

		return $errores;
	}

	/*function addCarrito($cesta,$carrito)
	{
		for($i=0;$i<sizeof($cesta);$i++)
		{
			$encontrado = false;
			for($j=0;$j<sizeof($carrito);$j++)
			{
				if($cesta[$i][0]==$carrito[$j][0])
				{
					$carrito[$j][1] += $cesta[$i][1];
					$encontrado = true;
					break;
				}
			}

			if($encontrado==false)
			{
				array_push($carrito,$cesta[$i]);
			}

			$sql_script = "UPDATE producto SET Stock = Stock - ".$cesta[$i][1]." WHERE CodProd = ".$cesta[$i][0].";";
			$this->ejecuta_SQL($sql_script);
		}

		return $carrito;
	}*/


	function buscarProductoPorNombre($nombre) {
		$sql = "SELECT CodProd, NombreProd, Stock, Precio FROM producto WHERE NombreProd LIKE :nombre";
		
		// Renombramos $stmt a algo más descriptivo
		$busca = $this->db->prepare($sql);
		$busca->execute(['nombre' => '%' . $nombre . '%']);
		
		// Retornamos los resultados
		return $busca->fetchAll(PDO::FETCH_ASSOC);
	}
	





	function addCarrito($cesta, $carrito)
	{
		for ($i = 0; $i < sizeof($cesta); $i++) {
			$encontrado = false;
	
			// Obtener precio del producto desde la base de datos si no está en $cesta
			if (!isset($cesta[$i][2])) {
				$sql_script = "SELECT Precio FROM producto WHERE CodProd = " . $cesta[$i][0];
				$resultado = $this->ejecuta_SQL($sql_script);
				$producto = $resultado->fetch(\PDO::FETCH_ASSOC);
				$cesta[$i][2] = $producto['Precio']; // Añadir el precio al elemento de $cesta
			}
	
			// Revisar si el producto ya está en el carrito
			for ($j = 0; $j < sizeof($carrito); $j++) {
				if ($cesta[$i][0] == $carrito[$j][0]) {
					$carrito[$j][1] += $cesta[$i][1]; // Sumar cantidades
					$encontrado = true;
					break;
				}
			}
	
			// Si no está en el carrito, agregarlo con el precio
			if ($encontrado == false) {
				array_push($carrito, $cesta[$i]);
			}
	
			// Actualizar el stock del producto
			$sql_script = "UPDATE producto SET Stock = Stock - " . $cesta[$i][1] . " WHERE CodProd = " . $cesta[$i][0] . ";";
			$this->ejecuta_SQL($sql_script);
		}
	
		return $carrito;
	}
	




	//funcion para borrar el contenido de carrito
	function borrarCarrito($carrito)
	{
		//bucle que recorre el carrito para eliminar los productos añadidos
		for($i=0;$i<sizeof($carrito);$i++)
		{
			$sql_script = "UPDATE producto SET Stock = Stock + ".$carrito[$i][1]." WHERE CodProd = ".$carrito[$i][0].";";
			$this->ejecuta_SQL($sql_script);
		}
		
		//devuelve el array vacio del carrito
		return array();
	}

	//funcion para los productos del carrito
	function ImprimirCarrito($carrito)
	{
		//ejecucion de consulta sql para mostrar los nombres de los productos
		$sql_script = "SELECT NombreProd FROM producto";
		$resultado=$this->ejecuta_SQL($sql_script);

		//muestra la lista de de productos
		$lista = $resultado->fetchAll(\PDO::FETCH_ASSOC);
		echo "<hr><table>
		<tr>
			<th>Nombre</th>
			<th>Cantidad</th>
			<th>Precio unidad</th>
			<th>Subtotal</th>
			<th></th>
		</tr>";
		//bucle por cada uno de los productos para mostrarlos en la tabla
		/*for($i=0;$i<sizeof($carrito);$i++)
		{
			echo "<tr>
			<td>".$lista[$carrito[$i][0]-1]['NombreProd']."</td>
			<td>".$carrito[$i][1]."</td>
			<td>".$carrito[$i][3]."</td>
			<td> <a href=carrito.php?DelProducto=" . $carrito[$i][0] . ">Borrar</a></td>
			</tr>";
		}*/

		$total = 0;

		for ($i = 0; $i < sizeof($carrito); $i++) {
			$nombreProducto = $lista[$carrito[$i][0] - 1]['NombreProd']; // Accede al nombre desde $lista
			$cantidad = $carrito[$i][1]; // Cantidad del producto
			$precioUnidad = isset($carrito[$i][2]) ? $carrito[$i][2] : 0; // Precio del producto, asegurando que exista
			$subtotal = $precioUnidad * $cantidad; // Precio total por las unidades
			$total += $subtotal;
		
			echo "<tr>
				<td>" . ($nombreProducto) . "</td>
				<td>" . ($cantidad) . "</td>
				<td>" . number_format($precioUnidad, 2) . " €</td>
				<td>" . number_format($subtotal, 2) . " €</td>
				<td><a href='carrito.php?DelProducto=" . ($carrito[$i][0]) . "'>Borrar</a></td>
			</tr>";
		}
		
			echo "<tr>
				<td colspan='4' style='text-align: right; font-weight: bold;'>Total:</td>
				<td>" . number_format($total, 2) . " €</td>
			</tr>
			</table>";

			
	}
	

	function calcularTotal($carrito) {
		$total = 0;
		for ($i = 0; $i < sizeof($carrito); $i++) {
			$precioUnidad = isset($carrito[$i][2]) ? $carrito[$i][2] : 0;
			$cantidad = $carrito[$i][1];
			$total += $precioUnidad * $cantidad;
		}
		return $total;
	}



	//funcion para borrar un producto del carrito
	function delProductoCarrito($carrito,$id_del)
	{
		//bucle que recorre el carrito para comprobar que elemento se ha pedido borrar
		for ($i = 0; $i < sizeof($carrito); $i++) {
			if ($carrito[$i][0] == $id_del) {

				//ejecucion de consulta sql para buscar y eliminar el producto a borrar
				$sql_script = "UPDATE producto SET Stock = Stock + ".$carrito[$i][1]." WHERE CodProd = ".$carrito[$i][0].";";
				$this->ejecuta_SQL($sql_script);

				//Quita el producto a eliminar y nos devuelve el array de carrito sin el producto que se ha eliminado
				array_splice($carrito, $i, 1);
				return $carrito; // Elemento eliminado
			}
		}
	}
	//funcion para crear un usuario
	function Crearusuario($nombre,$clave){
		//ejecucion de consulta sql para añadir a la base de datos la nueva cuenta (usuario y clave)
		$sql_script = "INSERT INTO cliente (Correo,Clave) VALUES ('$nombre','$clave')";
				$this->ejecuta_SQL($sql_script);

	}

//funcion para confirmar el pedido
	function ConfirmarPedido($carrito,$id_shop)
	{
		//crea el nuevo pedido en pedidos
		$sql_script = "INSERT INTO pedido (CodCliente, Fecha) VALUES ($id_shop,CURRENT_DATE)";
		$this->ejecuta_SQL($sql_script);

		//Obtenemos el nuevo id de pedido generado

		$sql_script = "SELECT MAX(CodPed) FROM pedido;";
		$resultado = $this->ejecuta_SQL($sql_script);
		$id_ped = $resultado->fetchAll(\PDO::FETCH_ASSOC)[0]['MAX(CodPed)'];

		for($i = 0; $i < sizeof($carrito); $i++)
		{	
			//introduce los productos del pedido en la base de datos
			$sql_script = "INSERT INTO pedidos_productos (CodPed, CodProd, Unidades) VALUES (".$id_ped.",".$carrito[$i][0].",".$carrito[$i][1].")";
			$this->ejecuta_SQL($sql_script);
			
		}
		//devuelvo un array vacio que borra todo el contenido de carrito
		return array();
	}

	//funcion para ver los pedidos
	function ImprimirPedidos($id_cliente)
	{

		//ejecucion de consulta sql para ver todos los pedidos realizados por un tienda
		$sql_script = "SELECT * FROM pedido WHERE CodCliente=$id_cliente";
		$resultado = $this->ejecuta_SQL($sql_script);
		//obtiene todos los pedidos del tienda en cuestion
		$pedidos = $resultado->fetchAll(\PDO::FETCH_ASSOC);
		
		//muestra en una tabla los pedidos realizados que obtiene la variable $pedidos
		echo "<table>
		<tr>
			<th>Nº de Pedido</th>
			<th>Fecha</th>
		</tr>";

		for($i=0;$i<sizeof($pedidos);$i++)
		{
			echo "<tr>
			<td>".$pedidos[$i]['CodPed']."</td>
			<td>".$pedidos[$i]['Fecha']."</td>
			<td> <form action='infopedido.php' method='POST'>
			<input type='hidden' name='Codped' value='".$pedidos[$i]['CodPed']."'>
			<button type='submit'>Info del pedido</button>
		  </form></td>
		</tr>";
		}

		echo "</table>";
	}
	


	function ImprimirDatosPedidos($Codpedido)
	{
		// Obtener los productos asociados al pedido
		$sql_script = "SELECT * FROM pedidos_productos WHERE CodPed=$Codpedido";
		$resultado = $this->ejecuta_SQL($sql_script);
		$pedidos = $resultado->fetchAll(\PDO::FETCH_ASSOC);

		echo "<h2>Pedido Nº: " . $Codpedido . "</h2>";
	
		echo "<table>
		<tr>
			<th>Nombre del producto</th>
			<th>Cantidad</th>
			<th>Precio unidad</th>
			<th>Subtotal</th>
		</tr>";
	
		$total = 0; // Variable para acumular el total del pedido
	
		for ($i = 0; $i < sizeof($pedidos); $i++) {
			$Codprodvar = $pedidos[$i]['CodProd'];
	
			// Obtener el nombre del producto y su precio
			$sql_script2 = "SELECT NombreProd, Precio FROM producto WHERE CodProd=$Codprodvar";
			$resultado2 = $this->ejecuta_SQL($sql_script2);
			$producto = $resultado2->fetch(\PDO::FETCH_ASSOC);
	
			$nombreProducto = $producto['NombreProd'];
			$precioUnidad = $producto['Precio'];
			$cantidad = $pedidos[$i]['Unidades'];
			$subtotal = $precioUnidad * $cantidad;
	
			// Acumular el total
			$total += $subtotal;
	
			echo "<tr>

				<td>" . htmlspecialchars($nombreProducto) . "</td>
				<td>" . $cantidad . "</td>
				<td>" . number_format($precioUnidad, 2) . " €</td>
				<td>" . number_format($subtotal, 2) . " €</td>
			</tr>";
		}
	
		// Mostrar el total del pedido
		echo "<tr>
			<td colspan='4' style='text-align: right; font-weight: bold;'>Total:</td>
			<td>" . number_format($total, 2) . " €</td>
		</tr>";
	
		echo "</table>";
	}
}