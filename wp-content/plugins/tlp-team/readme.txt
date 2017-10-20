=== Team ===
Contributors: techlabpro1
Donate link:
Tags: team, teams, team display, team members profile, our team, team members, meet the team, team plugin, wordpress team plugin, responsive team plugin, team showcase, team member display, members profiles, my team, our team, team showcase, team grid, team profile, stuff, our stuff, meet the stuff, team member showcase, team member wordpress plugin, wordpress team member plugin, wp team, team free, team free plugin, responsive team plugin
Requires at least: 4
Tested up to: 4.8
Stable tag: 2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Team plugin is fully Responsive WordPress Team member display plugin to create & manage your Team page easily. Your can display your Team members profile in grid and isotope views.

== Description ==

[Plugin Demo](http://demo.radiustheme.com/wordpress/plugins/tlp-team/) | [Documentation](
https://radiustheme.com/how-to-setup-configure-tlp-team-free-version-for-wordpress/) | [Get Pro Version](https://radiustheme.com/tlp-team-pro-for-wordpress/)

**Team**

Team plugin is fully responsive & mobile friendly team members display plugin in WordPress. You can display your team members in different layout like Grids and Isotope.

[youtube https://www.youtube.com/watch?v=3gm2ipm7wes]

From admin end you can easily add your team member(s). You can set primary color, image size and detail page (Yes/No) link. It has widget included with settings how many want to display. It has the following fields members name, position, image, short bios and detail bios and social links.

It is HTML5 & CSS3 base and full object oriented (OOP) coding. Display your team member profile with Grid view and Isotope View using our ShortCode and widget. It comes with 4 default layouts in shortcode you can call layout like `layout="1" / layout="2" / layout="3" / layout="isotope"`.


= Total 4 Layouts =
**Grid View 1:**
```
[tlpteam col="4" member="8" orderby="title" order="ASC" layout="1"]
```

**Grid View 2:**
```
[tlpteam col="2" member="8" orderby="date" order="ASC" layout="2"]
```

**Grid View 3 (Rounded Profile image):**
```
[tlpteam col="2" member="8" orderby="menu_order" order="ASC" layout="3"]
```
**Isotope View with Name and Designation Sorting:**
```
[tlpteam col="4" member="8" orderby="menu_order" order="ASC" layout="isotope"]
```

= For use template php file:- =
<code>
<?php echo do_shortcode('[tlpteam col="4" member="8" orderby="title" order="ASC" layout="1"]'); ?>
<?php echo do_shortcode('[tlpteam col="2" member="8" orderby="date" order="ASC" layout="2"]'); ?>
<?php echo do_shortcode('[tlpteam col="2" member="8" orderby="menu_order" order="ASC" layout="3"]'); ?>
<?php echo do_shortcode('[tlpteam col="4" member="8" orderby="menu_order" order="ASC" layout="isotope"]'); ?>
</code>

= Features =
* Fully Responsive & Mobile Friendly
* 4 Different layouts (3 Grid and 1 Isotope)
* Custom meta filed
* ShortCode Generator
* Color control
* 3 types of ordering title/ date/ menu_order
* Image Size option
* Widget
* Primary color control
* Detail link (Yes/No)


= Fully translatable =
* POT files included (/languages/)

= Available fields =
* Title/Name (Post Title)
* Description (Post Content)
* Short Bio (Custom field)
* Designations (Custom field)
* Email (Custom field)
* Personal Web URL (Custom field)
* Telephone (Custom field)
* Location (Custom field)
* Social links (FB, Twitter, LinkedIn, Youtube and Google+ )

= Shortcode settings =
* **Short Code:**
```
[tlpteam col="2" member="8" orderby="title" order="ASC" layout="1"]
```
* **col =** The number of column you want to display (1, 2, 3, 4)
* **member =** The number of the member, you want to display
* **orderby =** You can order by three ways (title, date, menu_order) here menu_order is custom order
* **order =** ASC, DESC
* **layout =** 1,2, 3, isotope

= Pro Features =
* Total 33 Layouts (14 Grid, 1 Table, 9 Isotope & 9 Carousel).
* Unlimited layout variation.
* Unlimited ShortCode Generator.
* Visual Composer compatibility.
* Drag & Drop ordering.
* Unlimited color.
* Gray scale image
* All fields control show/hide.
* All text size, color and text align control.
* Square / Rounded Image Style.
* Grid with Margin or No Margin.
* Social icon, color size and background color control.
* Detail page with Popup and Next Preview button.
* Skill fields with progress bar.
* Pagination (You can set how many show per page).
* Member Display by Department(s) wise.
* Specific Member(s) Display (Select by name in ShortCode)
* Detail Page Field control
* Category Ordering for Isotope Button.
* All Bottom color Control
* Single Member Popup
* Multiple Designation
* Added additional image for gallery
* Assign member as user
* Member Latest post show in detail/popup page
* Order by Random

[Get Pro Version](https://radiustheme.com/tlp-team-pro-for-wordpress/)

For any bug or suggestion please mail us: support@radiustheme.com

== Installation ==

Install and Activate

1. Unzip the downloaded 'tlp-team' zip file
2. Upload the 'tlp-team' folder and its contents into the 'wp-content/plugins/' directory of your WordPress installation
3. Activate 'tlp-team' from Plugins page

== Implement ==

1. Short Code : [tlpteam col=4 member=8 orderby=title order=ASC layout=1]
2. col = The number of column you want to create
3. member = The number of the member, you want to display
4. Go to the wp admin Widget page.
5. Drag and drop "TPL Team" into active sidebar.

= Requirements =
* **WordPress version:** >= 4.3
* **PHP version:** >= 5.2.4


== Frequently Asked Questions ==

= How to Use Portfolio =

* Go to `Team > Add Member`
* Go to page or post editor insert shortcode.

**Grid View 1:**
```
[tlpteam col="4" member="8" orderby="title" order="ASC" layout="1"]
```

**Grid View 2:**
```
[tlpteam col="2" member="8" orderby="date" order="ASC" layout="2"]
```

**Grid View 3 (Rounded Profile image):**
```
[tlpteam col="2" member="8" orderby="menu_order" order="ASC" layout="3"]
```
**Isotope View with Name and Designation Sorting:**
```
[tlpteam col="4" member="8" orderby="menu_order" order="ASC" layout="isotope"]
```

= Need Any Help? =

* Please mail us at `support@radiustheme.com`
* We provide `15 hours live support`

== Screenshots ==

01. Layout 1
02. Layout 2
03. Layout 3
04. Widget
05. Plugin Settings
06. Widget Settings
07. Layout Isotope


== Changelog ==

= 2.1 =
* WPML compatibility

= 1.9 =
* Add link with image
* Improve coding

= 1.8 =
* Fixed Javascript equal height issue

= 1.7 =
* Fix some console error
* Fix some php warning

= 1.5 =
* Private post is now visible by the admin
* Some jquery issue is fixed

= 1.4 =
* Add New Single page layout
* Fix the height problem on mobile
* Organize coding structure
* Remove unnecessary script

= 1.3 =
* Fix Grid height problem on mobile
* Update layout
* Fix some bug
* min height fixed

= 1.2 =
* Add new Sorting layout
* Fix some coding and layout bug
* And Extra setting for controlling color and detail link.


= 1.1 =
* Improve Responsive Layout.
* Added 2 more Layout.
* Widget Layout improve.
* Custom CSS option add.
* 2 more social icons added (youtube and google+)

= 1.0 =
* Initial load of the plugin.
