(function() {

	tinymce.PluginManager.add( 'tinymcs_plus', function( editor, url ) {

		$.each(editor.settings.shortcodes_data,function(index,shortcode){

            editor.addButton('tinymcs_plus_'+ shortcode["slug"], {
                title: shortcode["tooltip"],
                text: shortcode["text"],
                cmd: 'tinymcs_plus_cmd_'+ shortcode["slug"],
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

            editor.addCommand('tinymcs_plus_cmd_'+ shortcode["slug"], function() {

            	if(fields.length > 0){
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
                                    params.push(param["code"] + '="' + e.data[param["code"]] + '"');
                                }
                            });

                            if( params.length > 0 ) {
                                paramsString = ' ' + params.join(' ');
                            }

                            if(shortcode["close"] == "true"){
                                var returnText = '[' + shortcode["slug"] + ' ' + paramsString + ']<br><br>[/' + shortcode["slug"] + ']';
                                editor.execCommand('mceInsertContent', 0, returnText);
                            }
                            else{
                                var returnText = '[' + shortcode["slug"] + ' ' + paramsString + ']';
                                editor.execCommand('mceInsertContent', 0, returnText);
                            }
                        }
                    });
				}
				else{
                    if(shortcode["close"] == "true"){
                        var returnText = '[' + shortcode["slug"] + ']<br><br>[/' + shortcode["slug"] + ']';
                        editor.execCommand('mceInsertContent', 0, returnText);
                    }
                    else{
                        var returnText = '[' + shortcode["slug"] + ']';
                        editor.execCommand('mceInsertContent', 0, returnText);
                    }
				}

            });

		});
	});

})();