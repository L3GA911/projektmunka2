<span class="navname">Szabadsági kérelem törlése</span>
<div class="content_container">
<?php
	$id = "ID";
	$datum = "Kérvényezett szabadság napja";
?>
<table id="table" class="table table-striped table-bordered table2 wo_delete_size">
    <thead class="table-dark">
      <tr>
        <th><?=$id;?></</th>
        <th><?=$datum;?></</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-label="<?=$id;?>">12345</td>
        <td data-label="<?=$datum;?>">2015.04.26</td>
        <td>
			<button class="button_table">Törlés</button>
		</td>
      </tr>
    </tbody>
  </table>
</div>

<script type="text/javascript" src="js/editDataTable.js"></script>	