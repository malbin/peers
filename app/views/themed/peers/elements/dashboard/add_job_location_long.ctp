<?php
$this->Form->_inputDefaults = array('div' => array('class' => 'form-block form-block-clr'));
if (!empty($locationMappings['address'])) {
    echo $this->Form->input('Job.address',array('class' => 'text validate[required]', 'label' => $locationMappings['address']));
}
if (!empty($locationMappings['city'])) {
    echo $this->Form->input('Job.city',array('class' => 'text validate[required]', 'label' => $locationMappings['city']));
}
if (!empty($locationMappings['state'])) {
    echo $this->Form->input('Job.state',array('class' => 'text validate[required]', 'label'=> $locationMappings['state']));
}
if (!empty($locationMappings['zip_code'])) {
    echo $this->Form->input('Job.zip_code',array('div' => array('class' => 'form-block half-block'), 'class' => 'text validate[required]', 'label' => $locationMappings['zip_code']));
}
echo $this->Form->input('Job.salary', array('div' => array('class' => 'form-block half-block-float'), 'class' => 'text currency', 'label' => 'Salary', 'after' => '<span class="currency-text">' . $currency . '</span>'));
echo $this->Form->hidden('Job.currency', array('value' => $currency));
?>
<script type="text/javascript">
    window.currency_symbol = '<?php echo $currencySymbol; ?>';
</script>