<div class="row"
<p></p>
<div class="large-4 large-centered columns panel">
<h4>Please enter the following ...</h4>
<?php
// Template/Users/msf_step_3.ctp
echo $this->Form->create();
echo $this->Form->control('city');
echo $this->Form->control('zip');
echo $this->Html->link('Previous step',
    array('action' => 'msf_step', $params['currentStep'] -1),
    array('class' => 'button')
);
echo $this->Form->button(__('Next step'));
echo $this->Form->end();
?>
</div>
</div>
