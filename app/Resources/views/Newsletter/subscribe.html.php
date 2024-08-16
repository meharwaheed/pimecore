<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>


<?php echo $this->template('includes/contentblocks.html.php'); ?>

<div class="newsletter--container">
<?php if(!$this->success) { ?>

    <?php if($this->getParam("submit")) { ?>
        <div class="alert alert-danger">
            <?= $this->translate("Sorry, something went wrong, please check the data in the form and try again!"); ?>
        </div>
        <br />
        <br />
    <?php } ?>

    <div class="contentblock contentblock--wysiwyg">
        <p>
            Sie haben sich erfolgreich mit ihrer E-Mail-Adresse <strong><?= $this->getParam("email"); ?></strong> angemeldet. Bitte überprüfen Sie Ihren Posteingang!
        </p>
    </div>

<?php } else { ?>

    <div class="alert alert-success"><?= $this->translate("Success, Please check your mailbox!"); ?></div>
<?php } ?>
</div>
