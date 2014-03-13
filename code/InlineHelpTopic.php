<?php
/**
 * An inline help topic which is attached to a DOM selector on any number of
 * pages.
 *
 * @package silverstripe-inlinehelp
 */
class InlineHelpTopic extends DataObject {

	public static $db = array(
		'Title'          => 'Varchar(100)',
		'DisplayType'    => 'Enum("Tooltip, Link", "Tooltip")',
		'Text'           => 'HTMLText',
		'Link'           => 'Varchar(100)',
		'AttachType'     => 'Enum("All, Pages, Children, Type", "Pages")',
		'AttachPageType' => 'Varchar(100)',
		'DOMPattern'     => 'Varchar(100)',
		'ShowTooltip'    => 'Enum("Hover, Click", "Hover")',
		'TooltipWidth'   => 'Varchar(6)',
		'TooltipHeight'  => 'Varchar(6)',
		'IconHTML'       => 'HTMLVarchar(255)',
		'IconMy'         => 'Varchar(15)',
		'IconAt'         => 'Varchar(15)',
		'IconOffset'     => 'Varchar(10)',
		'TooltipMy'      => 'Varchar(15)',
		'TooltipAt'      => 'Varchar(15)'
	);

	public static $has_one = array(
		'ParentFilter' => 'SiteTree'
	);

	public static $many_many = array(
		'Pages' => 'SiteTree'
	);

	public static $defaults = array(
		'ShowTooltip' => 'Hover',
		'DisplayType' => 'Tooltip',
		'AttachType'  => 'Pages'
	);

	public static $summary_fields = array(
		'Title',
		'DisplayType',
		'AttachedTo'
	);

	public static $searchable_fields = array(
		'Title'       => array('filter' => 'PartialMatchFilter'),
		'AttachType'  => array('filter' => 'ExactMatchFilter'),
		'DisplayType' => array('filter' => 'ExactMatchFilter'),
		'Text'        => array('title'  => 'Help text', 'filter' => 'PartialMatchFilter'),
		'Link'        => array('title'  => 'Help link', 'filter' => 'PartialMatchFilter')
	);

	/**
	 * Returns a summary/description of the pages this help object is attached
	 * to.
	 *
	 * @return string
	 */
    public function getAttachedTo() {
        switch ($this->AttachType) {
            case 'All':
                return 'All pages';
            case 'Pages':
                if($this->Pages()->Count() >0)return 'Specific pages: ' . implode(', ', $this->Pages()->toArray()->map());
            case 'Children':
                return 'Children of ' . $this->ParentFilter()->Title;
            case 'Type':
                return 'Pages of type ' . $this->AttachPageType;
        }
    }

	/**
	 * @return FieldSet
	 */
	public function getCMSFields() {
		//Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript('inlinehelp/javascript/InlineHelpAdmin.js');

		return new FieldList(new TabSet('Root',
			new Tab('Main',
				new HeaderField('HelpHeader', 'Help Topic'),
				new TextField('Title', 'Title'),
				new OptionSetField('DisplayType', 'Display type', array(
					'Tooltip' => 'Display help text and/or link in tooltip',
					'Link'    => 'Click the icon to go to the help link'
				)),
				new HtmlEditorField('Text', 'Short help text', 8),
				new TextField('Link', 'Help link')
			),
			new Tab('Subject',
				new HeaderField('SubjectHeader', 'Help Subject(s)'),
				new TextField('DOMPattern', 'DOM pattern'),
				new LiteralField('DOMPatternNote', '<p>This is a jQuery (CSS)
				selector which specifies which elements to attach this help
				topic to. The same topic can be attached to multiple elements.
				</p>')
			),
			new Tab('AttachTo',
				new HeaderField('AttachToHeader', 'Attach Help To'),
				new OptionSetField('AttachType', '', array(
					'All'      => 'All pages',
					'Pages'    => 'Specific pages',
					'Children' => 'Children of the selected page',
					'Type'     => 'Instances of a specific page type'
				)),
				new TreeMultiSelectField('Pages', 'Pages', 'SiteTree'),
				new TreeDropdownField('ParentFilterID', 'Parent page', 'SiteTree'),
				new DropdownField('AttachPageType', 'Page type', ArrayLib::valuekey(
					ClassInfo::subclassesFor('Page')
				))
			),
			new Tab('Advanced',
				new HeaderField('AdvancedHeader', 'Advanced Inline Help Options'),
				new DropdownField('ShowTooltip', 'Show tooltip on', array(
					'Hover' => 'On mouse hover',
					'Click' => 'On mouse click'
				)),
				new TextField('IconHTML', 'Icon HTML code'),
				new FieldGroup('Help icon position (relative to subject)',
					new TextField('IconMy', 'my'),
					new TextField('IconAt', 'at')
				),
				new FieldGroup('Help icon offset (relative to position)',
					new TextField('IconOffset', ''),
					new LiteralField('IconOffsetNote',
						'format "horizontal vertical" (e.g. "15 -5")')
				),
				new FieldGroup('Tooltip position (relative to icon)',
					new TextField('TooltipMy', 'my'),
					new TextField('TooltipAt', 'at')
				),
				new LiteralField('HelpPositionNote', '<p>These allow you to
				specify the position of the elements relative to each other.
				Each position is in the format "horizontal vertical", where
				horizontal can be one of left, center or right (default
				center), and vertical can be top, center or bottom (default
				center)</p>'),
				new FieldGroup('Tooltip size',
					new TextField('TooltipWidth', ''),
					new LiteralField('SizeSeparator', 'x'),
					new TextField('TooltipHeight', ''),
					new LiteralField('DefaultSizeNote', '(default: 300 x "auto")')
				)
			)
		));
	}

}