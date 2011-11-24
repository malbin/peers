<?php
if (!empty($locationMappings['address'])) {
    echo $this->Form->input('Job.address',array('class' => 'text validate[required]', 'label' => false, 'placeholder' => $locationMappings['address']));
}
if (!empty($locationMappings['city'])) {
    echo $this->Form->input('Job.city',array('class' => 'text validate[required]', 'label' => false, 'placeholder' => $locationMappings['city']));
}
if (!empty($locationMappings['state'])) {
    echo $this->Form->input('Job.state',array('class' => 'text validate[required]', 'label' => false, 'placeholder'=> $locationMappings['state']));
}
if (!empty($locationMappings['zip_code'])) {
    echo $this->Form->input('Job.zip_code',array('class' => 'text validate[required]', 'label' => false, 'placeholder' => $locationMappings['zip_code']));
}
?>
<div class="base-sal-cal">
    <?php
    echo $this->Form->input('Job.salary',array('label'=>'Base Salary', 'div'=>array('class'=>'input half-block'), 'class'=>'validate[required,custom[currency]] currency'));
	echo $this->Form->input('Job.currency',array('class'=>'currency','type'=>'hidden','label'=>false, 'div'=>false, 'value' => $currency));
    echo $this->Form->input('Job.start_date_display',array('type'=>'text','class'=>'datepicker','label'=>'As of&hellip;','after' => '<span class="calendar small"></span>', 'div'=>array('class'=>'input half-block half-block-calendar')));
    echo $this->Form->input('Job.start_date',array('type'=>'hidden'));
    ?>
</div>
<span class="currency"><?php echo $currency; ?></span>
<input type="submit" value="add" class="add-job-xpnd-button" />
<script type="text/javascript">
    window.currency_symbol = '<?php echo $currencySymbol; ?>';
</script>
