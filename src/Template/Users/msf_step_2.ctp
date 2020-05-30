<div class="row"
<p></p>
<div class="large-4 large-centered columns panel">
<h4>Please enter the following ...</h4>
<?php
// Template/Users/msf_step_2.ctp
echo $this->Form->create();
echo $this->Form->input('birthdate');
echo $this->Form->input('sex');
echo $this->Form->input('mobile');
echo $this->Html->link('Previous step',
    array('action' => 'msf_step', $params['currentStep'] -1),
    array('class' => 'button')
	);
	echo $this->Form->button(__('Next step'));

echo $this->Form->end();
?>
</div>
</div>
