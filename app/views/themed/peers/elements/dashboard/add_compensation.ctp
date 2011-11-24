<div class="compensations form">
<?php echo $this->Form->create('Compensation', array('url' => array('controller' => 'compensations', 'action' => 'add'), 'onSubmit'=>'return add_compensation()')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('type', array('label' => 'Type of Compensation','div'=>array('class'=>'full-block'), 'class'=>'validate[required]','type'=>'select','options'=>array('Signing'=>'Signing', 'Performance'=> 'Performance','Severance'=>'Severance','Other'=>'Other')));
		echo $this->Form->input('Compensation.cash', array('div'=>array('class'=>'half-block'), 'class'=>'validate[groupRequired[cash_deferred],custom[currency]] currency compensationCash', 'data-prompt-position'=>'topLeftShort'));
		echo $this->Form->input('Compensation.deferred', array('div'=>array('class'=>'half-block half-block-right'), 'class'=>'validate[groupRequired[cash_deferred],custom[currency]] currency compensationDeferred'));
		echo $this->Form->input('Compensation.currency', array('div'=>false, 'type'=>'hidden', 'value'=>$user['currency']));
		echo $this->Form->input('Compensation.award_date_display',array('type'=> 'text','label'=>'Award Date','class'=>'datepicker','div'=>array('class'=>'half-block')));
        echo $this->Form->input('Compensation.award_date',array('type'=>'hidden'));
	?>
	</fieldset>
	<input type="submit" value="add now" class="add-comp-xpnd-button">
<?php echo $this->Form->end();?>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		/*
		$('#typeSelect').css('margin-bottom','0').selectbox();
		*/

	});
</script>