<?php
function paginate($page, $tpages, $adjacents,$report, $fechaIni, $fechaFin) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out = '<ul class="pagination   pull-right">';
	// previous label

	if($report == 0){
		if($page==1) {
			$out.= "<li class='page-item disabled'><a>$prevlabel</a></li>";
		} else if($page==2) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(1,".$report.")'>$prevlabel</a></li>";
		}else {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(".($page-1).",".$report.")'>$prevlabel</a></li>";

		}
		
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(1,".$report.")'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li class='page-item'><a>...</a></li>";
		}

		// pages

		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active page-item'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(1,".$report.")'>$i</a></li>";
			}else {
				$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(".$i.",".$report.")'>$i</a></li>";
			}
		}

		// interval

		if($page<($tpages-$adjacents-1)) {
			$out.= "<li class='page-item'><a>...</a></li>";
		}

		// last

		if($page<($tpages-$adjacents)) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load($tpages,".$report.")'>$tpages</a></li>";
		}

		// next

		if($page<$tpages) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(".($page+1).",".$report.")'>$nextlabel</a></li>";
		}else {
			$out.= "<li class='disabled page-item'><a>$nextlabel</a></li>";
		}
		
		$out.= "</ul>";
		return $out;
	}
	else if($report == 1)
	{
		if($page==1) {
			$out.= "<li class='page-item disabled'><a>$prevlabel</a></li>";
		} else if($page==2) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(1,".$report.",".$fechaIni.",".$fechaFin.")'>$prevlabel</a></li>";
		}else {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(".($page-1).",".$report.",".$fechaIni.",".$fechaFin.")'>$prevlabel</a></li>";
	
		}
		
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(1,".$report.",".$fechaIni.",".$fechaFin.")'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li class='page-item'><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active page-item'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(1,".$report.",".$fechaIni.",".$fechaFin.")'>$i</a></li>";
			}else {
				$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(".$i.",".$report.",".$fechaIni.",".$fechaFin.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li class='page-item'><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load($tpages,".$report.",".$fechaIni.",".$fechaFin.")'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li class='page-item'><a href='javascript:void(0);' onclick='load(".($page+1).",".$report.",".$fechaIni.",".$fechaFin.")'>$nextlabel</a></li>";
		}else {
			$out.= "<li class='disabled page-item'><a>$nextlabel</a></li>";
		}
		
		$out.= "</ul>";
		return $out;
	}
}
?>