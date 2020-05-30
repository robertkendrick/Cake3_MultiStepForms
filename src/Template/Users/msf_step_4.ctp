<div class="row"
<p></p>
<div class="large-4 large-centered columns panel">
<h4>Please enter the following ...</h4>
<?php
// Template/Users/msf_step_4.ctp
echo $this->Form->create('User');
echo $this->Form->input('about');
echo $this->Form->input('interests');
echo $this->Form->input('job');
echo $this->Html->link('Previous step',
    array('action' => 'msf_step', $params['currentStep'] -1),
    array('class' => 'button')
);
echo $this->Form->button(__('Save'));
echo $this->Form->end();
?>
</div>
</div>
