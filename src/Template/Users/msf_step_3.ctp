<div class="container">
<div class="medium-6 columns">
<?php
// Template/Users/msf_step_3.ctp
echo $this->Form->create('User');
echo $this->Form->input('city');
echo $this->Form->input('zip');
echo $this->Html->link('Previous step',
    array('action' => 'msf_step', $params['currentStep'] -1),
    array('class' => 'button')
);
echo $this->Form->button(__('Next'));
echo $this->Form->end();
?>
</div>
</div>
