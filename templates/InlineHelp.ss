<% if HelpItems %>
	<% require css(sapphire/thirdparty/jquery-ui-themes/base/jquery.ui.all.css) %>
	<% require css(inlinehelp/css/ss.inlinehelp.css) %>

	<% require javascript(sapphire/thirdparty/jquery/jquery.js) %>
	<% require javascript(sapphire/thirdparty/jquery-ui/jquery-ui-1.8rc3.custom.js) %>
	<% require javascript(sapphire/thirdparty/jquery-livequery/jquery.livequery.js) %>
	<% require javascript(inlinehelp/javascript/ss.inlinehelp.js) %>

(function($) {
	<% control HelpItems %>
		$('$DOMPattern').livequery(function() { $(this).inlineHelp({
			<% if IconMy && IconAt %>
			iconPosition: {
				<% if IconOffset %>offset: '$IconOffset',<% end_if %>
				my: '$IconMy.JS',
				at: '$IconAt.JS'
			},
			<% end_if %>
			<% if TooltipMy && TooltipAt %>
			tooltipPosition: {
				my: '$TooltipMy.JS',
				at: '$TooltipAt.JS'
			},
			<% end_if %>
			<% if TooltipWidth && TooltipHeight %>
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
	<% end_control %>
})(jQuery);
<% end_if %>