<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
$this->extend('layout.html.php');
?>

<?php if ( $this->editmode ) { ?>
    <?php echo $this->template('includes/contentblocks.html.php'); ?>
<?php } else { ?>
    <?php if(!$this->success) { ?>
        <div class="contentblock contentblock--wysiwyg">
            <?= $this->translate("Sorry, something went wrong, please sign up again!"); ?>
        </div>
    <?php } else { ?>
        <div class="contentblock contentblock--wysiwyg">
            <?= $this->translate("Ab jetzt erhalten Sie unsere Newsletter!"); ?>
        </div>
    <?php } ?>
<?php } ?>
