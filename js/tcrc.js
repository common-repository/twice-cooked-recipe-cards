(function($) {
	$(document).ready(function () {
		theRecipeCard('#tcrc-recipebutton', '#tcrc-recipe');
	});
	
	//creates the recipe card
	function theRecipeCard(cardID, recipeID) {
		var printerCSS = '<link rel="stylesheet" type="text/css" href="' + tcrc_vars.printercss + '" media="screen" />';
		if (tcrc_vars.customprintercss.length > 1) {
			printerCSS += '\n<!-- TCRC Custom Style -->\n<style type=\"text/css\">\n' + tcrc_vars.customprintercss + '\n</style>\n';
		}
		var theContent = $(recipeID).html();
//		if (theContent) theContent = theContent.replace(/<br\s*[\/]?>/, "");
		var theTitle = $(recipeID + ' .tcrc-fn').html();
		var theSource = '';

		if ($('.site-title').html() != '') {
			theSource += $('.site-title').text();
		}
		if ($('.site-description').html() != '') {
			theSource += ': ' + $('.site-description').text();
		}

		$(cardID).click(function () {
			var recipeWindow = window.open('', 'Printable Recipe','width=750, scrollbars=yes, menubar=no,location=no, toolbar=no, resizable=yes');
			recipeWindow.document.write('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\n\n<html>\n\n<head>\n\n<title>' + theTitle + '</title>\n\n' + printerCSS + '\n\n</head>\n\n<body>\n\n<div class="thesource">\n\n' + theSource + '\n\n</div>\n\n<div id="tcrc-recipe" class="tcrc-recipe hrecipe">\n\n' + theContent + '\n\n</div>\n\n</body>\n\n</html>');
			recipeWindow.document.close();
			return false;
		});
	}
})( jQuery );