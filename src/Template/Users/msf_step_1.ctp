
<div class="row" style="">
<!--
<div class="large-3 columns"></div>
-->
<p></p>
<div class="large-4 large-centered columns panel">
<h4>Please enter the following ...</h4>
<?php
echo $this->Form->create();
echo $this->Form->control('username');
echo $this->Form->control('password');
echo $this->Form->control('first_name');
echo $this->Form->control('last_name');
?>
</div>
<!--
<div class="large-2 columns end"></div>
-->
</div> <!-- row -->

<div class="row">
	<div class="large-4 large-centered columns">
		<?php
		echo $this->Form->button(__('Next >>'));
		echo $this->Form->end();
		?>
	</div>
</div>

<div class="row">
	<div class="large-6 columns">...</div>
	<div class="large-6 columns">...</div>
</div>
