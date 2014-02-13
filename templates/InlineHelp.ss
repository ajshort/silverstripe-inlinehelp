<% if $HelpItems %>
	<% require css(framework/thirdparty/jquery-ui-themes/smoothness/jquery-ui.min.css) %>
	<% require css(inlinehelp/css/ss.inlinehelp.css) %>

	<% require javascript(framework/thirdparty/jquery/jquery.min.js) %>
	<% require javascript(framework/thirdparty/jquery-ui/jquery-ui.min.js) %>
	<% require javascript(framework/thirdparty/jquery-livequery/jquery.livequery.js) %>
	<% require javascript(inlinehelp/javascript/ss.inlinehelp.js) %>

(function($) {
	<% loop $HelpItems %>
		$('$DOMPattern').livequery(function() { $(this).inlineHelp({
			<% if $IconHTML %>icon: '$IconHTML.JS',<% end_if %>
			<% if $IconMy && $IconAt %>
			iconPosition: {
				<% if $IconOffset %>offset: '$IconOffset.JS',<% end_if %>
				my: '$IconMy.JS',
				at: '$IconAt.JS'
			},
			<% end_if %>
			<% if $TooltipMy && $TooltipAt %>
			tooltipPosition: {
				my: '$TooltipMy.JS',
				at: '$TooltipAt.JS'
			},
			<% end_if %>
			<% if $TooltipWidth && $TooltipHeight %>
			tooltipSize: {
				width: $TooltipWidth.JS,
				height: $TooltipHeight.JS
			},
			<% end_if %>
			type: '$DisplayType.Lower.JS',
			title: '$Title.JS',
			text: '$Text.JS',
			link: '$Link.JS',
			showOn: '$ShowTooltip.Lower.JS'
		}); });
	<% end_loop %>
})(jQuery);
<% end_if %>