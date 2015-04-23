<div id="calendario" class="contenedor">
	
	<div class="filtros">
		<div class="fechas">
			<h2>FECHAS</h2>
			<div class="linkscalendario">
				<a class="calendario_criterio" href="home/calendario_criterio/todas">TODAS</a>
				<a class="calendario_criterio" href="home/calendario_criterio/hoy">HOY</a>
				<a class="calendario_criterio" href="home/calendario_criterio/maniana">MAÑANA</a>
				<a class="calendario_criterio" href="home/calendario_criterio/semana">EN LA SEMANA</a>
				<a class="calendario_criterio" href="home/calendario_criterio/mes">ESTE MES</a>
			</div>
		</div>
	</div>

	<div class="fechascal">

	

	<?php

	foreach ($fecha as $item) {
	?>
		
		<div class="itemcal">
			<div class="imgitem">
				<img src="<?= base_url("assets/img/calimgs/$item->imagen") ?>" alt="">
			</div>
			<div class="infoitem">
				<h2 class="fecbandas"><?= $item->nombre ?></h2>
				<p class="fecitem"><?= date('d-m-Y', strtotime($item->dia)). " - ". substr($item->hora,0,-3) ?> hs</p>
				<p class="feclugar"><?= $item->lugar ?></p>
				<p class="fecbandas">
				<?php 
				$bnds = "";
				/*foreach ($bandasxfecha as $bf){ 
					if ($item->fid == $bf->id_fecha){ 
						$bnds = $bnds . $bf->nombre." - ";
					}
				} */

				echo substr($bnds,0,-3);

				?>
				
				</p>
			</div>
		</div>

	<?php } ?>

	</div>

</div>
