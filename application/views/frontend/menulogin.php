<div class="dashboard col-lg-10 col-md-10 col-sm-10 col-xs-10">
	<ul>
		<li class="panel col-lg-3 col-md-3">
			<div class="row panaelnoconfirmados panelheader">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-9 col-md-9 text-right">
					<div class="numeropanel"><?= $noconfirmados ?></div>
					<div>Bandas sin confirmar</div>
				</div>
			</div>
			<div class="panelfooter">
				<a href="confirmarbandas" class="definirbandas text-left">Confirmar Bandas</a>
			</div>
		</li>
		<li class="panel col-lg-3 col-md-3">
			<div class="row panelnoturno panelheader">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-9 col-md-9 text-right">
					<div class="numeropanel"><?= $noturno ?></div>
					<div>Bandas sin turno</div>
				</div>
			</div>
			<div class="panelfooter">
				<a href="definirturnos" class="definirbandas">Definir turno</a>
			</div>
		</li>
		<li class="panel col-lg-3 col-md-3">
			<div class="row panelnoconvocatoria panelheader">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-9 col-md-9 text-right">
					<div class="numeropanel"><?= $noconvocatoria ?></div>
					<div>Bandas sin convocatoria</div>
				</div>
			</div>
			<div class="panelfooter">
				<a href="definirconvocatorias" class="definirbandas text-left">Definir convocatoria</a>
			</div>
		</li>
	</ul>
</div>
