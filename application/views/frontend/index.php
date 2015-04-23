<div class="contenedor">
	<div class="contenedorCell">
		<div class="contenedorBlock">
			<div class="flexslider">
				<?php 

				setlocale(LC_TIME, 'es_ES');
				
				?>
				<ul class="slides">
					<?php
						for ($i=0; $i < 3; $i++) { 

						if(isset($infofechaslider[$i])){
						$slider = $imagenes[$i]["imagen"];

						?>
							
							<li>
								<div class="fechainfoslider">
								<h2 class="wow fadeInLeftBig"><?= $infofechaslider[$i]["fecnom"] ?></h2>
								<p class="wow fadeInRightBig"><?= $infofechaslider[$i]["lugnom"] ?> - <?= strftime("%A %d de %B",strtotime($infofechaslider[$i]["dia"])) ?> <?= substr($infofechaslider[$i]["hora"],0,-3) ?>HS</p>
								</div>
								<img src="<?= base_url("assets/img/slider/$slider") ?>">
							</li>

						<?php }} ?>
				</ul>
			</div>
		</div>
	</div>
	
<div class="agenda">
	<div class="agendaTitulo">
		<h2 class="wow fadeInLeftBig">PRÓXIMAS</h2>
		<h2 class="wow fadeInRightBig">FECHAS</h2>
	</div>

	<div class="row da-thumbs" id="da-thumbs">

		<?php for ($j=0; $j < 4; $j++) { ?>
		
		<!-- Fijarse que para el ultimo div en sm es hidden-sm  -->

		<div class="col-md-3 col-sm-4 col-xs-6">

			<?php

			$ocurrencias = [$j,$j+4,$j+8,$j+12];

			foreach ($ocurrencias as $i) { 

			if(isset($infofechaagenda[$i])){

			$imgevento = $infofechaagenda[$i]["imagen"];
			
			?>
				
				<div class="dtli">
					<a href="javascript:void(0);">
					<img src="<?= base_url("assets/img/eventos/$imgevento") ?>" alt="">
					<div>
						<span>
							<p class="fecha-agenda"><?= strftime("%A %d de %B",strtotime($infofechaagenda[$i]["dia"])) ?></p>
							<p><?= $infofechaagenda[$i]["lugnom"] ?></p>
							<p><?= substr($infofechaagenda[$i]["hora"],0,-3) ?></p>
						</span>
					</div>
					</a>
				</div>
				
			<?php }} ?>

		</div>

		<?php } ?>

	</div>

	
	<div  class="proximas-fechas" style="display:none">
		<?php echo anchor('calendario', 'Proximas Fechas', 'title="Proximas Fechas"'); ?>
	</div>

</div>

</div>
