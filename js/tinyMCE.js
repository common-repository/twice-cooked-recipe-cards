(function() {
	tinymce.create('tinymce.plugins.tcrc', {
		//Initializes the plugin
		init : function(ed, url) {
			ed.addButton('tcrc', {
				type : 'listbox',
				text : 'Recipe Card Shortcodes',
				title : 'Highlight each recipe component, then click for the appropriate shortcode',
				icon : false,
				classes : 'btn fixed-width',
				onselect: function(e) {
					ed.execCommand(this.value());
				},
				values : [
					{ text : 'Ingredient', value : 'ingredient' },
					{ text : 'Instructions', value : 'instructions' },
					{ text : 'Duration', value : 'duration' },
					{ text : 'Yield', value : 'yield' },
					{ text : 'Nutrition', value : 'nutrition' },
					{ text : 'Summary', value : 'summary' },
				],
				onPostRender: function() {
					this.value('ingredient');
				}
			});
			ed.addButton('hrecipe', {
				title : 'New Recipe Card - all recipe components should be inside this tag',
				cmd : 'hrecipe',
				image : url + '../../images/hrecipe.png'
			});
/*			ed.addButton('ingredient', {
				title : 'Ingredient - each ingredient should be wrapped in this tag',
				cmd : 'ingredient',
				image : url + '../../images/ingredient.png'
			});
			ed.addButton('instructions', {
				title : 'Instructions - may be in prose form or a list',
				cmd : 'instructions',
				image : url + '../../images/instructions.png'
			});
			ed.addButton('duration', {
				title : 'Duration - how long the recipe takes to prepare',
				cmd : 'duration',
				image : url + '../../images/duration.png'
			});
			ed.addButton('yield', {
				title : 'Yield - how much food your recipe makes',
				cmd : 'yield',
				image : url + '../../images/yield.png'
			});
			ed.addButton('nutrition', {
				title : 'Nutrition - calories per serving',
				cmd : 'nutrition',
				image : url + '../../images/nutrition.png'
			});
			ed.addButton('summary', {
				title : 'Summary - a short description of your recipe',
				cmd : 'summary',
				image : url + '../../images/summary.png'
			});*/

			ed.addCommand('hrecipe', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				var fn = prompt("What is the title of your recipe?"), shortcode;
				if ( (fn != null) && (fn != '') ) {
					return_text = '[recipe][recipename]' + fn + '[/recipename]' + selected_text + '[/recipe]';
					ed.execCommand('mceInsertContent', 0, return_text);
				} else {
					alert("Your recipe needs a title. It is required.");
				}	
			});			
			ed.addCommand('ingredient', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[ingredient]' + selected_text + '[/ingredient]';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
			ed.addCommand('instructions', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[instructions]' + selected_text + '[/instructions]';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
			ed.addCommand('duration', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[duration]' + selected_text + '[/duration]';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
			ed.addCommand('yield', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[yield]' + selected_text + '[/yield]';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
			ed.addCommand('nutrition', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[nutrition]' + selected_text + '[/nutrition]';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
			ed.addCommand('summary', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[summary]' + selected_text + '[/summary]';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
		 
		},
		 
		//Creates Control
		createControl : function(n, cm) {
			return null;
		},
		 
		//Returns info about the plugin
		getInfo : function() {
			return {
				longname : 'Twice Cooked Recipe Cards, Supplementary Buttons',
				author : 'Adam D. Zolkover',
				authorurl : 'https://basilosaur.us/',
				infourl : '',
				version : "1.0"
			};
		}
	});
	// Register plugin
	tinymce.PluginManager.add( 'tcrc', tinymce.plugins.tcrc );
})();