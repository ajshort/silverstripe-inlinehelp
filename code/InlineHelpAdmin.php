<?php
/**
 * Allows {@link InlineHelpTopic}s to be managed via a CMS interface.
 *
 * @package silverstripe-inlinehelp
 */
class InlineHelpAdmin extends ModelAdmin {

	public static $menu_title = 'Inline Help';

	public static $url_segment = 'inline-help';

	public static $managed_models = 'InlineHelpTopic';

	public static $model_importers = array();

	public function init() {
		parent::init();
		HtmlEditorConfig::set_active('simple');
	}

}