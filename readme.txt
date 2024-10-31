=== Plugin Name ===
Author: BenIrvin
Tags: admin, id, search, post
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 1.0

Allows search by id in admin by prefixing id with #.

== Description ==

Allows search by id in admin by prefixing id with #.  For example, search for #123 returns post id 123.  Original idsearch function written by t31os on the experts-exchange.com forums.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. You can now, for example, search for post id 123 by doing a search for "#123"

== Frequently Asked Questions ==

= Can I change the prefix from # to something else? =

Not via the admin (yet).  Add this to your themes functions.php and replace the # with any character you desire:
<code>
function asid_prefix_replacement($wp) {
	global $ASID_PREFIX;
	$ASID_PREFIX = '#';
}
add_action( 'parse_request', 'asid_prefix_replacement', 99 );
</code>

== Screenshots ==

1. Search in action!

== Changelog ==

= 1.0 =
* created the first release

== Upgrade Notice ==

= 1.0 =
Because the plugin didn't exist before now.

== A brief Markdown Example ==

Features added in version 1.0:

* everything thus far
