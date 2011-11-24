<html>
    <body>
        <div style="background: #ece9e7; background: rgba(23, 22, 21, 0.2); border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 15px; width: 400px;">
            <div style="background: #fefefe; box-shadow: 0 0 5px rgba(67,44,24,0.2); -moz-box-shadow: 0 0 5px rgba(67,44,24,0.2); -webkit-border-radius: 0 0 5px rgba(67,44,24,0.2); padding: 20px 25px;">
                <p style="text-align: center;">
                    <?php echo $this->Html->image(FULL_BASE_URL . 'theme/peers/img/PR-email-logo.png', array('url' => $this->Html->url('/', true), 'alt' => 'Peers and Rivals')); ?>
                </p>
                <div style="background: #fdf7eb; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; padding: 20px 0;">
                    <?php echo $content_for_layout; ?>
                </div>
                <p style="color: #b0a79e; font-family: Arial; font-size: 12px; font-weight: bold; margin-top: 18px; padding-bottom: 10px;">&copy; <?php echo date('Y'); ?> Peers &amp; Rivals</p>
            </div>
        </div>
    </body>
</html>