;(function($) {
	Behaviour.register({
		'#AttachType': {
			initialize: function() {
				$(this).find(':checked').change();
			}
		},
		'#DisplayType': {
			initialize: function() {
				$(this).find(':checked').change();
			}
		}
	});

	$('#AttachType :radio').live('change', function() {
		switch ($(this).val()) {
			case 'All':
				$('#ParentFilterID').hide();
				$('#Pages').hide();
				$('#AttachPageType').hide();
				break;

			case 'Pages':
				$('#ParentFilterID').hide();
				$('#Pages').show();
				$('#AttachPageType').hide();
				break;

			case 'Children':
				$('#ParentFilterID').show();
				$('#Pages').hide();
				$('#AttachPageType').hide();
				break;

			case 'Type':
				$('#ParentFilterID').hide();
				$('#Pages').hide();
				$('#AttachPageType').show();
				break;
		}
	});

	$('#DisplayType :radio').live('change', function() {
		switch ($(this).val()) {
			case 'Tooltip':
				$('#Text.htmleditor').show();
				break;

			case 'Link':
				$('#Text.htmleditor').hide();
				break;
		}
	});
})(jQuery);