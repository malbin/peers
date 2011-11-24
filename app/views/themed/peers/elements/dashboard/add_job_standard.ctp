<div class="add-job-xpand-stndrd add-job-lightbox">
	<?php
	echo $this->Form->create('Job', array('onSubmit'=>'return add_job()','url' => array('controller' => 'jobs', 'action' => 'add'), 'class'=>'validate[required]'));
	echo $this->Form->input('Job.title',array('label'=>'Job Title','class'=>'validate[required]'));
	echo $this->Form->input('Employer.name',array('label'=>'Company','class'=>'validate[required]'));
    echo $this->Form->input('Job.country_id',array('label'=>'Location', 'div'=>array('class'=>'selectbox-input'), 'data-location-fields-type' => 'short', 'empty' => 'Select Country'));
    ?>
    <div id="add-job-location-fields">
    </div>
	<span class="clr">&nbsp;</span>
	<?php echo $this->Form->end();?>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('.add-job-lightbox #JobCountryId').css('margin-bottom','0').selectbox();
	});
</script>