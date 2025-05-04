<?php
class One_Click_Mark extends Plugin {

	/** @var PluginHost $host */
	private $host;

	function about() {
		return array(null,
			"Adds additional single click 'Mark as read' buttons on main toolbar",
			"nneul");
	}

    function init($host) {
        $this->host = $host;

		$host->add_hook($host::HOOK_MAIN_TOOLBAR_BUTTON, $this);
        $host->add_hook($host::HOOK_TOOLBAR_BUTTON, $this);
        $host->add_hook($host::HOOK_PREFS_TAB, $this);
	}

	function hook_main_toolbar_button() {
        $disable_dropdown = $this->host->get($this, "disable_dropdown");

        if ( $disable_dropdown ) {
            print "<style>#main-catchup-dropdown { display: none !important; }</style>";
        }

        $disable_button = $this->host->get($this, "disable_left_button");

        if ( ! $disable_button ) {
            print "<button dojoType=\"dijit.form.Button\" onclick=\"Feeds.catchupCurrent('')\"><i class=\"material-icons\">done_all</i>" . __('Mark as read') . "</button>\n";
        }
	}

	function hook_toolbar_button() {
        $disable_button = $this->host->get($this, "disable_right_button");

        if ( ! $disable_button ) {
            print "<button dojoType=\"dijit.form.Button\" onclick=\"Feeds.catchupCurrent('')\"><i class=\"material-icons\">done_all</i>" . __('Mark as read') . "</button>\n";
        }
    }

    function hook_prefs_tab($args) {
        if ($args != "prefPrefs") return;
        $disable_left_button = $this->host->get($this, "disable_left_button");
        $disable_right_button = $this->host->get($this, "disable_right_button");
        $disable_dropdown = $this->host->get($this, "disable_dropdown");

        $disable_left_button_checked = $disable_left_button ? "checked" : "";
        $disable_right_button_checked = $disable_right_button ? "checked" : "";
        $disable_dropdown_checked = $disable_dropdown ? "checked" : "";

        ?>
        <div dojoType="dijit.layout.AccordionPane"
            title="<i class='material-icons'>extension</i> <?= __("One Click Mark Plugin") ?>">
            <form dojoType="dijit.form.Form">

                <?= \Controls\pluginhandler_tags($this, "save") ?>

                <script type="dojo/method" event="onSubmit" args="evt">
                    evt.preventDefault();
                    if (this.validate()) {
                        Notify.progress('Saving data...', true);
                        xhr.post("backend.php", this.getValues(), (reply) => {
                            Notify.info(reply);
                        })
                    }
                </script>

                <header><?= __("Enable/disable buttons:") ?></header>
                <p>

                <?= \Controls\checkbox_tag("disable_left_button", $disable_left_button_checked, "on", [], "disable_left_button"); ?>
                <label for="disable_left_button"><?= __("Hide left Mark as read button") ?></label>

                <p>

                <?= \Controls\checkbox_tag("disable_right_button", $disable_right_button_checked, "on", [], "disable_right_button"); ?>
                <label for="disable_right_button"><?= __("Hide right Mark as read button") ?></label>

                <p>

                <?= \Controls\checkbox_tag("disable_dropdown", $disable_dropdown_checked, "on", [], "disable_dropdown"); ?>
                <label for="disable_dropdown"><?= __("Hide Mark as read menu") ?></label>

                <hr/>

                <?= \Controls\submit_tag(__("Save")) ?>
            </form>
        </div>
        <?php
    }

    function save() : void {
        $disable_left_button = checkbox_to_sql_bool($_POST["disable_left_button"]) == true;
        $this->host->set($this, "disable_left_button", $disable_left_button);

        $disable_right_button = checkbox_to_sql_bool($_POST["disable_right_button"]) == true;
        $this->host->set($this, "disable_right_button", $disable_right_button);

        $disable_dropdown = checkbox_to_sql_bool($_POST["disable_dropdown"]) == true;
        $this->host->set($this, "disable_dropdown", $disable_dropdown);

        echo __("Configuration saved.");
    }

	function api_version() {
		return 2;
	}

}
?>
