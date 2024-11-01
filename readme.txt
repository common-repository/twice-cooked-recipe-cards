=== Twice Cooked Recipe Cards ===
Contributors: basilosaur_us
Donate link: https://basilosaur.us/wordpress/plugins/tcrc/
Tags: recipe, recipes, recipe cards, food, food blog, cooking, formatting, post, plugin, shortcode, shortcodes, TinyMCE, editor, jQuery, javascript, plugin
Requires at least: 3.0.1
Tested up to: 4.0.0
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Twice Cooked Recipe Cards by basilosaur.us helps you turn your recipes into fancy printable recipe cards, complete with SEO-friendly microformats.

== Description ==

Twice Cooked Recipe Cards by basilosaur.us (https://basilosaur.us/) helps you turn your blog's recipes into fancy electronic recipe cards. This plugin provides you with all the tools you need to create microformatting that helps search engines recognize ingredients, instructions, and whole recipes. And it provides a mechanism to create pop-out, printable pages so that readers can easily add your recipe to their physical collection in the kitchen.

= On the Front End =

When you add TCRC recipe tags to your post, the plugin automatically creates formatting that, with an elegant, modern, minimalist look, sets your recipe off from the rest of your writing, and adds distinctive formatting for ingredients, time, yield, and instructions. And it creates a pop-out button for users which, when clicked, loads a version of the recipe that is specially formatted for printing cleanly and easily on most inkjet and laser printers.

= On the Back End =

To help you format your recipes, TCRC gives you six new shortcodes which create the recipe card and implement microformat.org's hRecipe schema for improved search-engine optimization:

 * [recipe] - This is the key TCRC shortcode. It creates a section in your post that has the hRecipe class, that formats your recipe such that it stands out, and that creates the print button. In order to effectively use the other shortcodes, this one is required first.
 * [recipename] - Use this shortcode to title your recipe. Microformat.org's hRecipe schema requires that every recipe have a title. And for a recipe to be really printer friendly, it should be titled anyway.
 * [ingredient] - Wrap each of your ingredients in the [ingredient] shortcode. At least one ingredient is required by the microformats.org schema.
 * [duration] - How long does your recipe take to make from start to finish? For example: 1 hour 30 minutes.
 * [yield] - How much food does this recipe make?
 * [instructions] - Wrap your set of instructions in this shortcode. Not every step requires a separate tag, so you only need to use this once.
 * [nutrition] - How many calories, or calories per serving, is your recipe?
 * [summary] - A short description, usually at the beginning of your recipe, of what it is. This is particularly great for folks who print your recipe cards.


But you don't have to memorize all this stuff. Twice Cooked Recipe Cards also extends WordPress' visual editor with toolbar buttons that make recipe formatting a piece of cake. Highlight your recipe, then use the New Recipe button to create the [recipe] and [recipename] tags in one simple step. Then use the handy dropdown box to create your ingredients, instructions, duration, yield, etc.

= Acknowledgements =

The hand-drawn icons that populate both the front and back ends of Twice Cooked Recipe Cards were drawn by Agata Kuczmińska and are free to use for both personal and commercial purposes. You can find more of her work here.

== Installation ==

1. Upload the 'twice-cooked-recipe-card' directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Start adding TCRC shortcodes to your blog posts right away!

== Frequently Asked Questions ==

= Can I add custom css classes to my recipe card? =

Absolutely! Inside the [recipe] shortcode, simply add class="", and then the name of your custom CSS class within the quotes.  Like: [recipe class="foo"].

= Why have you not implemented x tag or microformat? =

I'd be happy to do so. Just send me a request and a link to the relevant section of microformat.org's hRecipe spec, and I'll get on it in the next version.

= Are there other frequently asked questions? =

Not yet!  But ask away, and I'll add the answers here.

== Screenshots ==

1. When you edit a recipe, note the TCRC icons in TinyMCE's toolbar.  You may either use these to create your recipe, or you may use the simple TCRC shortcodes.
2. In your posts, TCRC will add minimalist, modern styling to your recipe even as it provides a pop-out button and hRecipe microformats.
3. Pop-out recipes are clean, clear, and friendly for printers.

== Changelog ==

= 1.0 =
* This is the initial release.

= 1.1 =
* Popout window now uses external stylesheet
* Title text for the print icon
* Added options page, which allows users to add custom CSS to recipe cards both in posts, and in the pop-out window

= 1.2 =
* fixes a potential conflict with the 'yield' function
* more completely implements the hRecipe spec by adding 'nutrition' and 'summary' shortcodes
* streamlines the editor interface by creating a dropdown box of shortcodes rather than individual buttons

== Upgrade Notice ==

= 1.0 =
This is the initial release.

= 1.1 =
Fixes some initial inefficiencies in the code, and adds an options page to the 'Settings' section of the Dashboard. This allows users to add custom CSS to recipe cards both as they appear in posts, and in the pop-out menu.

= 1.2 =
Includes several important bug fixes, adds additional shortcodes ('nutrition' and 'summary') to more completely implement the hRecipe spec, and streamlines the interface inside of the WordPress editor.
