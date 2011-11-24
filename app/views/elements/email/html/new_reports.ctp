<table width="100%">
    <tr>
        <td style="color: #554c42; font-family: Arial; font-size: 60px; padding: 0 12px; text-align: center;"><?php echo $reportCount; ?></td>
        <td style="border-right: 1px dotted #d0c7bd; color: #554c42; font-family: Arial; font-size: 21px; padding-right: 20px;">
            New <?php __n('Report', 'Reports', $reportCount); ?><br />
            Available
        </td>
        <td style="padding-left: 20px;">
            <?php echo $this->Html->image(FULL_BASE_URL . 'theme/peers/img/PR-email-view-now.png', array('url' => Router::url('/dashboard', true), 'alt' => 'View Now')); ?>
        </td>
    </tr>
</table>