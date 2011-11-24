<div id="modal-forgot-password" class="modal-lightbox" style="display: none;">
    <div class="modal-mask">&nbsp;</div>
    <div class="modal-body-wrapper">
        <div class="modal-body">
            <a href="javascript:void(0);" class="modal-close">&#10006;</a>
            <h1><img src="/theme/peers/img/PR-email-shield.png" title="Peers and Rivals"></h1>
            <p class="message">Enter your email address:</p>
            <?php
            echo $this->Form->create('User', array('controller' => 'users', 'action' => 'forgot_password'));
            echo $this->Form->input('email', array('label' => false, 'class' => 'validate[required,custom[email]]'));
            echo $this->Form->submit('Recover Password', array('class' => 'button'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $('.forgot').click(function(){
        $('#modal-forgot-password').fadeIn(500);
    });
    
    $('#modal-forgot-password form')
        .validationEngine({
            validationEventTrigger: 'blur',
            promptPosition : 'topRight',
            scroll: false
        })
        .submit(function(){
            var $form = $(this);
            if ($form.validationEngine('validate')) {
                var postData = $form.serializeObject();
                $.post(BASEURL + 'forgot_password?ajax=true&output=json', postData, function(data){
                    if (data.form_result.success) {
                        $('.modal-lightbox:visible').fadeOut(200);
                    } else {
                        for (var key in data.form_result.errors) {
                            var field = $form.find('*[name="data\\[User\\]\\[' + key + '\\]"]');
                            if (field.length != 0) {
                                field.validationEngine('showPrompt', data.form_result.errors[key]);
                            }
                        }
                    }
                }, 'json');
            }
            return false;
        });
})
</script>
