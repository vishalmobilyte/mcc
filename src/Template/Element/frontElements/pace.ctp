<?php
	echo $this->Html->css(['pace.css']); 
	echo $this->Html->script(['pace.js']);
 ?>

<div class="pace pace-active">
	<div class="pace-progress" ></div>
</div>
<script>
	$(document).ready(function() {
     	Pace.options = {
			ajax: false
		};
    });
</script>
