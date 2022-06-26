<?php
class One_Click_Catchup extends Plugin {

	function about() {
		return array(null,
			"Adds additional single click 'Mark as read' buttons on main toolbar",
			"nneul");
	}

	function init($host) {
		$host->add_hook($host::HOOK_MAIN_TOOLBAR_BUTTON, $this);
		$host->add_hook($host::HOOK_TOOLBAR_BUTTON, $this);
	}

	function hook_main_toolbar_button() {
		?>

        <button onclick="Feeds.catchupCurrent('')"><?= __('Mark as read') ?></button>

		<?php
	}

	function hook_toolbar_button() {
		?>

        <button onclick="Feeds.catchupCurrent('')"><?= __('Mark as read') ?></button>

		<?php
	}

	function api_version() {
		return 2;
	}

}
?>
