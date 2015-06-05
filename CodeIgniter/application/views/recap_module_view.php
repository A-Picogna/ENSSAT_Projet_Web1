<h3><?php echo $titre;?></h3>
<table class='table table-striped'>
	<tr>
		<th>Identifiant</th>
		<th>Libellé</th>
		<th>Public</th>
		<th>Semestre</th>
		<th>Responsable</th>
	</tr>
	<tr>
		<td><?php echo $this->session->userdata('module')["ident"];?></td>
		<td><?php echo $this->session->userdata('module')["libelle"];?></td>
		<td><?php echo $this->session->userdata('module')["public"];?></td>
		<td><?php echo $this->session->userdata('module')["semestre"];?></td>
		<td><?php echo $this->session->userdata('module')["idResponsable"];?></td>
	</tr>
</table>

<?php 
if ($this->session->userdata('moduleCours') != null): ?>
<table class='table table-striped'>
	<tr>
		<th>Partie</th>
		<th>Type</th>
		<th>Hed</th>
		<th>Enseignant</th>
	</tr>
<?php foreach($this->session->userdata('moduleCours') as $cours):?>
	<tr>
		<td><?php echo $cours["partie"]; ?></td>
		<td><?php echo $cours["type"]; ?></td>
		<td><?php echo $cours["hed"]; ?></td>
		<td><?php echo $cours["idEnseignant"]; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

