<?php
echo $this->Form->create('User', array(
    'id' => 'signup-form-details',
    'url' => array('controller' => 'users', 'action' => 'signup', '?' => array('ajax' => 'true', 'output' => 'json')),
    'target' => '_blank',
    'inputDefaults' => array('div' => array('class' => 'form-block form-block-clr'))
));
?>
<div class="wrapper irgbawrapper icur3">
    <div class="iform signup-form">
        <p class="form-text text-one">Enter Your</p>
        <p class="form-text text-two">Personal Information</p>
        
        <!-- copied from prev. tab -->
        <?php echo $this->Form->input('User.phone', array('label' => false, 'div' => false, 'type' => 'hidden', 'id' => 'phone-placeholder')); ?>
        <?php echo $this->Form->input('User.phone_carrier', array('label' => false, 'div' => false, 'type' => 'hidden', 'value' => 'att')); ?>
        
        <?php echo $this->Form->input('User.first_name', array('label' => 'First Name', 'div' => array('class' => 'form-block half-block-float'), 'class' => 'text validate[required,custom[onlyLetterSp]]', 'data-prompt-position' => 'topLeft')); ?>
        <?php echo $this->Form->input('User.last_name', array('label' => 'Last Name', 'div' => array('class' => 'form-block half-block-float'), 'class' => 'text validate[required,custom[onlyLetterSp]]')); ?>
                    
        <div class="form-block form-block-clr user-birthday">
            <label for="userBirthdate">Year of Birth</label>
            <select id="userBirthdate" name="data[User][birthdate][year]">
                <?php for ($i = (date('Y') - 18); $i >= 1920; $i--): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>;
                <?php endfor; ?>
            </select>
        </div>
                    
        <div class="form-block form-block-clr gender-select">
					Male <input type="radio" value="male" name="data[User][gender]" checked >
					Female <input type="radio" value="female" name="data[User][gender]" >
        </div>
        
        <?php echo $this->Form->input('User.email', array('class' => 'text validate[required,custom[email]]', 'label' => 'Email')); ?>
        <?php echo $this->Form->input('User.password', array('class' => 'text validate[required]', 'label' => 'Password', 'id' => 'password_main')); ?>
        <?php echo $this->Form->input('User.verify_password', array('type' => 'password', 'class' => 'text validate[required,equals[password_main]]', 'label' => 'Password Confirmation', 'id' => 'password_confirm')); ?>
    </div>
</div>
<div class="wrapper icur3 irgbawrapper signup-form" id="next-wrap">
    <div id="form2" class="iform">
        <p class="form-text text-one">Enter Your</p>
        <p class="form-text text-two">Professional Information</p>
        <?php echo $this->Form->input('Employer.name', array('class' => 'text validate[required]', 'label' => 'Company Name', 'div' => array('class' => 'form-block form-block-clr type-ahead'))); ?>
        <?php echo $this->Form->input('Job.title', array('class' => 'text validate[required]', 'label' => 'Job Title', 'div' => array('class' => 'form-block form-block-clr type-ahead'))); ?>
        <?php echo $this->Form->input('Job.country_id', array('class' => 'text selectbox validate[required]', 'label' => 'Country', 'data-location-fields-type' => 'long')); ?>
        <div id="add-job-location-fields">
            <?php
            $selectedCountry = (!empty($this->data['Job']['country_id']) ? $this->data['Job']['country_id'] : (count($countries) > 0 ? current($countries) : null));
            if ($selectedCountry) {
                echo $this->requestAction('/jobs/location/' . $selectedCountry . '/long');
            }
            ?>
        </div>
        <?php echo $this->Form->input('Job.start_date', array('div' => array('class' => 'form-block half-block', 'id' => 'calendar-and-as'), 'class' => 'text datepicker', 'type' => 'text', 'label' => 'As of&hellip;', 'after' => '<span class="calendar"></span>')); ?>
        <p class="form-text text-two separator">&nbsp;</p>
        <input type="submit" name="continue" value="Continue" id="signup-details-submit">
    </div>
</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$('#userBirthdate, #JobCountryId').selectbox();
    $('#JobCountryId_input').addClass('text');
});
</script>
