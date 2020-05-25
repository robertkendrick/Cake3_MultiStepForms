<div class="container">
<div class="medium-6 columns">
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
