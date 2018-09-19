(function() {
	$.each( shorcodesData, function( key, shortcode ) {

		tinymce.PluginManager.add( 'tinymcs_plus_'+ shortcode["slug"], function( editor, url ) {
			
			editor.addButton('tinymcs_plus_'+ shortcode["slug"], {
				title: shortcode["text"],
				text: shortcode["tooltip"],
				cmd: 'tinymcs_plus_'+ shortcode["slug"],
			}); 

			var fields = [];
			$.each( shortcode.params, function( key, param ) {
				fields.push({
					type: 'textbox',
					name: param["code"],
					label: param["text"],
					minWidth: 500,
					value: ''
				});
			});

			editor.addCommand('tinymcs_plus_'+ shortcode["slug"], function() {
				var win = editor.windowManager.open({
					title: ' Configuration',
					body: fields,
					buttons: [
						{
							text: "Ok",
							subtype: "primary",
							onclick: function() {
								win.submit();
							}
						},
						{
							text: "Cancel",
							onclick: function() {
								win.close();
							}
						}
					],
					onsubmit: function(e){
						var params = [];

						$.each( shortcode.params, function( key, param ) {
							if( e.data[param["code"]].length > 0 ) {
								params.push(param["code"] + '="' + e.data + '"');
							}
						});

						if( params.length > 0 ) {
							paramsString = ' ' + params.join(' ');
						}
						
						var returnText = '[' + shortcode["slug"] + ' ' + paramsString + ']';
						editor.execCommand('mceInsertContent', 0, returnText);
					}
				});
			});
			
		});

	});
})();