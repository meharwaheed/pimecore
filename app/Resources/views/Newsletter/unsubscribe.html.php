<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>

<?php echo $this->template('includes/contentblocks.html.php'); ?>

<?php if(!$this->success) { ?>

    <?php if ($this->unsubscribeMethod) { ?>
        <div class="alert alert-danger">
            <?php if ($this->unsubscribeMethod == "email") { ?>
                <div class="contentblock contentblock--wysiwyg">
                    Ihre E-Mail-Adresse befindet sich nicht in unserer Datenbank!
                </div>
            <?php } else { ?>
                <div class="contentblock contentblock--wysiwyg">
                    Ihr Unsubscribe-Token ist nicht valide!
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <form role="form" action method="post">

        <div class="form">
            <div class="form--element form--element-twocols">
                <label>
                    <div><?= $this->translate("E-Mail"); ?></div>
                    <div>
                        <input
                            name="email"
                            type="text"
                            placeholder="beispiel@beispiel.at"
                            required
                            value="<?= $this->escape($this->getParam("email")); ?>">
                    </div>
                </label>
            </div>
            <div class="form--element text-right">
                <input type="submit" name="submit" class="button" value="<?= $this->translate("Abmelden"); ?>">
            </div>
        </div>

    </form>

<?php } else { ?>
    <div class="contentblock contentblock--wysiwyg">
        Sie wurden erfolgreich aus unserem Newsletter-System abgemeldet!
    </div>
<?php } ?>
