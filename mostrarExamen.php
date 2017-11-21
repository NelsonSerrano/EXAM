<?php
$idExamen = $_POST['idExamen'];
require_once('control/conexion.php');
$resultadoExamen= mysqli_query($link, "SELECT * from examen WHERE id_examen = '$idExamen'");
while ($rowExamen = mysqli_fetch_array($resultadoExamen)) {
			   $id = $rowExamen['id_examen'];
			   $examen = $rowExamen['nombre_examen'];
			   $estado = $rowExamen['estado'];
}
 							
 						echo"	
 							<tbody>
							  <tr>
							      <th width='5'>id<th>
							      <th>Examen</th>
							      <th>Estado</th>
							      <th>Activar</th>
							    </tr>

							    <tr>
							      <td>$id<td>
							      <td>$examen</td>
							      <td>
									$estado
							  	  </td>
							  	  <td id='lastTd'>
							  	  </td>
							  	  
							    </tr>
							    
							   
							</tbody>";

?>
