(function() {
    tinymce.PluginManager.add( 'tinymcs_plus', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('tinymcs_plus', {
            title: 'Insert Button Link',
            text: "Fishing Shotcode",
            cmd: 'tinymcs_plus',
        }); 
        // Add Command when Button Clicked
		editor.addCommand('tinymcs_plus', function() {
		    var win = editor.windowManager.open({
			    title: 'Blockquote Properties',
			    body: [
			      {
			        type: 'textbox',
			        name: 'type',
			        label: 'Fishing Type',
			        minWidth: 500,
			        value: ''
			      },
			      {
			        type: 'textbox',
			        name: 'species',
			        label: 'Species',
			        minWidth: 500,
			        value: ''
			      },
			      {
			        type: 'textbox',
			        name: 'destination',
			        label: 'Destination',
			        minWidth: 500,
			        value: ''
			      }
			    ],
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
				  if( e.data.type.length > 0 ) {
				    params.push('type="' + e.data.type + '"');
				  }
				  if( e.data.species.length > 0 ) {
				    params.push('species="' + e.data.species + '"');
				  }
				  if( e.data.destination.length > 0 ) {
				    params.push('destination="' + e.data.destination + '"');
				  }
				  if( params.length > 0 ) {
				    paramsString = ' ' + params.join(' ');
				  }
				  var returnText = '[fishingbla ' + paramsString + ']';
				  editor.execCommand('mceInsertContent', 0, returnText);
				}
			});
		});
    });
})();