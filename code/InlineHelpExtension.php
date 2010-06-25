<?php
/**
 * Adds support for inline help items to a SiteTree object.
 *
 * @package silverstripe-inlinehelp
 */
class InlineHelpExtension extends DataObjectDecorator {

	/**
	 * @return array
	 */
	public function extraStatics() {
		return array('belongs_many_many' => array(
			'HelpTopics' => 'InlineHelpTopic'
		));
	}

	/**
	 * Includes the required JS libraries and inline help definitions.
	 */
	public function contentcontrollerInit() {
		$template = 'InlineHelp';
		$include  = $this->owner->renderWith($template);

		if ($include) Requirements::customScript($include);
	}

	/**
	 * Returns all the {@link InlineHelpTopic}s attached to this page.
	 *
	 * @return InlineHelpTopic[]
	 */
	public function getHelpItems() {
		$items = new DataObjectSet();

		$items->merge(DataObject::get('InlineHelpTopic',
			'"AttachType" = \'All\''));
		$items->merge($this->owner->HelpTopics());

		$stack = $this->owner->parentStack();
		array_shift($stack);

		if ($stack) {
			$items->merge(DataObject::get('InlineHelpTopic', sprintf(
				'"AttachType" = \'Children\' AND "ParentFilterID" IN(%s)',
				implode(', ',
					array_map(create_function('$self', 'return $self->ID;'),
					$stack))
			)));
		}

		$items->removeDuplicates();
		return $items;
	}

}