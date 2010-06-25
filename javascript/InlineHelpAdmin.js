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
				break;

			case 'Pages':
				$('#ParentFilterID').hide();
				$('#Pages').show();
				break;

			case 'Children':
				$('#ParentFilterID').show();
				$('#Pages').hide();
				break;
		}
	});

	$('#DisplayType :radio').live('change', function() {
		switch ($(this).val()) {
			case 'Tooltip':
				$('#Text').show();
				break;

			case 'Link':
				$('#Text').hide();
				break;
		}
	});
})(jQuery);