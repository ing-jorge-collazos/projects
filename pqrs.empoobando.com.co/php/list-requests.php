<?php
	
require_once ("conexionDB.php");
session_start();
$area = $_SESSION["area"];
$report = $_REQUEST["report"];
    
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags(strtoupper($_REQUEST['query']), ENT_QUOTES)));

	$campos="*";
	if($report == 0){
		$tables="pqrs";
		$sWhere=" (pqrs.numero_radicado LIKE '%".$query."%'";    
		$sWhere.=" || pqrs.identificacion LIKE '%".$query."%')";
		$sWhere.=" and pqrs.area LIKE '".$area."'";
		$sWhere.=" order by pqrs.fecha_solicitud DESC";
	}
	else if($report == 1){
		$tables="pqrs_seg ps 
				inner join pqrs p on p.id = ps.id_pqrs";
		$dateStart = $_REQUEST["dateStart"];
		$dateEnd = $_REQUEST["dateEnd"];

		if($dateStart==0 && $dateEnd ==0){
			$sWhere=" (p.numero_radicado LIKE '%".$query."%'";    
			$sWhere.=" || p.identificacion LIKE '%".$query."%')";
			$sWhere.=" and p.area LIKE '".$area."'";
			$sWhere.=" and ps.estado = p.estado";
			$sWhere.=" order by p.fecha_solicitud DESC";
		}else{
			$sWhere=" (p.numero_radicado LIKE '%".$query."%'";    
			$sWhere.=" || p.identificacion LIKE '%".$query."%')";
			$sWhere.="  and (DATE(ps.fecha_seguimiento) >= '".$dateStart."'";    
			$sWhere.=" and DATE(ps.fecha_seguimiento) <= '".$dateEnd."')";
			$sWhere.=" and p.area LIKE '".$area."'";
			$sWhere.=" and ps.estado = p.estado";
			$sWhere.=" order by ps.fecha_seguimiento DESC";
		}
	}	
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
    $count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");    
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data  
		
	if ($numrows>0){
		
	?>
	<?php
		if ($report==1)
		{
			if($dateStart==0 && $dateEnd ==0){
				$p = mysqli_query($con,"SELECT count(*) cantidad 
										FROM pqrs
										WHERE area LIKE '".$area."' 
										AND estado = 'Pendiente'");
				$ep = mysqli_query($con,"SELECT count(*)  cantidad 
										FROM pqrs
										WHERE area LIKE '".$area."' 
										AND estado = 'En Proceso'");
				$f = mysqli_query($con,"SELECT count(*)  cantidad 
										FROM pqrs
										WHERE area LIKE '".$area."'
										AND estado = 'Finalizada'");
			}else
			{
				$p = mysqli_query($con,"SELECT count(*) cantidad 
										FROM pqrs p
										INNER JOIN pqrs_seg ps on ps.id_pqrs = p.id
										WHERE p.area LIKE '".$area."' 
										AND p.estado = 'Pendiente'
										AND ps.estado = p.estado
										AND DATE(ps.fecha_seguimiento) >= '".$dateStart."'
										AND DATE(ps.fecha_seguimiento) <= '".$dateEnd."'");
				$ep = mysqli_query($con,"SELECT count(*) cantidad 
										FROM pqrs p
										INNER JOIN pqrs_seg ps on ps.id_pqrs = p.id
										WHERE p.area LIKE '".$area."' 
										AND p.estado = 'En Proceso'
										AND ps.estado = p.estado
										AND DATE(ps.fecha_seguimiento) >= '".$dateStart."'
										AND DATE(ps.fecha_seguimiento) <= '".$dateEnd."'");
				$f = mysqli_query($con,"SELECT count(*) cantidad 
										FROM pqrs p
										INNER JOIN pqrs_seg ps on ps.id_pqrs = p.id
										WHERE p.area LIKE '".$area."' 
										AND p.estado = 'Finalizada'
										AND ps.estado = p.estado
										AND DATE(ps.fecha_seguimiento) >= '".$dateStart."'
										AND DATE(ps.fecha_seguimiento) <= '".$dateEnd."'");
			}
			
			$p_row = mysqli_fetch_assoc($p);
			$ep_row = mysqli_fetch_assoc($ep);
			$f_row = mysqli_fetch_assoc($f);
		?>		
			<div class="table-responsive">
				<table class="table table-striped table-hover text-center">
					<thead>
						<tr>
							<th class='text-center'>Pendiente</th>
							<th class='text-center'>En Proceso</th>
							<th class='text-center'>Finalizada</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $p_row["cantidad"]?></td>
								<td><?php echo $ep_row["cantidad"]?></td>
								<td><?php echo $f_row["cantidad"]?></td>
							</tr>
						</tbody>
				</table>
			</div>	
	<?php
		}
	?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th class='text-center'>Número de Radicado</th>
                        <th class='text-center'>Identificación</th>
                        <th class='text-center'>Nombres</th>
                        <th class='text-center'>Email</th>
                        <th class='text-center'>Tipo de Solicitud</th>
						<th class='text-center'>Asunto</th>
						<th class='text-center'>Estado</th>
						<?php
							if($report==0){
						?>
							<th class='text-center'>Operaciones</th>
						<?php
							}
						?>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$id=$row['id'];
                            $numero=$row['numero_radicado'];
                            $identificacion=$row['identificacion']==null?'N/A':$row['identificacion'];
                            $nombres=$row['nombres']==null?'N/A':$row['nombres'];
                            $apellidos=$row['apellidos']==null?'':$row['apellidos'];
                            $telefono=$row['telefono']==null?'N/A':$row['telefono'];
                            $email=$row['email'];
                            $tipo_sol=$row['tipo_solicitud'];
                            $asunto=$row['asunto'];
                            $area=$row['area'];
                            $estado=$row['estado'];				
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $numero;?></td>
                            <td class='text-center'><?php echo $identificacion;?></td>
                            <td class='text-center'><?php echo $nombres .' '.$apellidos;?></td>
                            <td class='text-center'><?php echo $email;?></td>
                            <td class='text-center'><?php echo $tipo_sol;?></td>
                            <td class='text-center'><?php echo $asunto;?></td>
							<td class='text-center'>
								<?php 
									if($estado=='Pendiente')
										echo "<span style='color:#ff3729;'>$estado</span>";
									else if($estado=='En Proceso')
										echo "<span style='color:#3279fc;'>$estado</span>";
									else if($estado=='Finalizada')
										echo "<span style='color:#4afc32;'>$estado</span>";
								?>
							</td>


							<!--<td class='text-right'>--><?php /*echo number_format($price,2);*/?><!--</td>-->
							<td>
								<?php
									if($estado!='Finalizada' && $report==0){
									    if($estado!='En Proceso' && $report==0){
    										echo "<a href='#'  data-target='#editProductModal' class='details' data-toggle='modal' 
    															data-id='$id'
    															data-num='$numero'
    															data-email='$email'
    															data-area='$area'>
    															<i class='material-icons' data-toggle='tooltip' title='Detalles'>preview</i>
    											</a>";                          
    										echo "<a href='#' id='progress' class='check' data-toggle='modal' 
    															data-id='$id'
    															data-num='$numero'
    															data-email='$email'
    															data-area='$area'>
    															<i class='material-icons' data-toggle='tooltip' title='En Proceso'>trip_origin</i>
    											</a>";  								  
									    }
										echo "<a href='#' id='finish' class='finish' data-toggle='modal' 
															data-id='$id'
															data-num='$numero'
															data-email='$email'
															data-area='$area'>
															<i class='material-icons' data-toggle='tooltip' title='Finalizar'>fact_check</i>
											</a>";
									}
								?>                         
                    		</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan='6'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";
									if($report == 0){
										echo paginate( $page, $total_pages, $adjacents, $report, 0, 0);
									}
									else if($report == 1){
										echo paginate( $page, $total_pages, $adjacents, $report, $dateStart, $dateEnd);
									}
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		</div>	
	<?php	
	}else
		echo "No se encuentran registros en la búsqueda.";
}
?>          