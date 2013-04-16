Backend Utilities AddOn für REDAXO 4
====================================

Dieses REDAXO-AddOn dient als Container für PlugIns die das Backend erweitern/ergänzen.
Es bietet eine Übersichtseite und für die PlugIns die Möglichkeit eigene Seiten, z.B. für
Einstellungen hinzuzufügen.

Features
--------

* Übersichtsseite mit allen installierten PlugIns
* Jedes PlugIn kann eine eigene Einstellungsseite haben
* Vereinfachte Einbindung der PlugIns möglich

Mitgelieferte PlugIns
---------------------

* `Articlename Sync` Synchronisiert bei Änderung Kategoriename mit Artikelname und umgekehrt.
* `Category Separator` Erzeugt einen Trenner nach einer angegebenen Kategorie.
* `CodeMirror` Syntax Highlighting für TextAreas (Templates, Module, etc.).
* `Colorizer` Einfärben von REDAXO-Installationen inkl. Colorpicker und cooler automatisch generierter Favicons. 
* `Frontend Link` Fügt ins Menü rechts oben einen Link zum Frontend hinzu.
* `Hide Startarticle` Unbenutzte Startartikel können mit diesem Tool versteckt werden.
* `jQuery UI` jQuery UI inkl. und Aristo Skin und jQuery Cookie Plugin für persistente Tabs.
* `Rex Globals` Einige Tools damit Module und Templates auf globale PHP-Klassen und CSS-Styles zugreifen können.
* `Update Date` Mini Toolkit um das Update Datum der Website zu ermitteln.

Weitere PlugIns
---------------

* `Favicon` Nachrüsten eines Favicons für ältere REDAXO Versionen.
* `Phpinfo` Zeigt detaillierte Informationen über den Webserver inkl. PHP, MySQL Variablen usw. an.

Vereinfachte Einbindung eines PlugIns
-------------------------------------

Ein PlugIn kann ganz einfach in der `config.inc.php` des PlugIns eingebunden werden:

```php
if ($REX['REDAXO']) { // only backend
	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'my_plugin', 'Mein Plugin', 'Eine kurze Beschreibung.', '1.0.0', 'Der Autor', 'forum.redaxo.de', /* $hasBackendPage = */ true, /* $permission = '' */);

	// ...
}
```

In der `help.inc.php` des PlugIns lässt sich der Beschreibungstext so anzeigen:

```php
// show plugin description
echo rex_plugin_factory::getPluginDescription('be_utilities', 'my_plugin');
```

Klassische Einbindung eines PlugIns
-----------------------------------

Alternativ lässt sich ein PlugIn auch wie gewohnt einbinden:

```php
if ($REX['REDAXO']) { // only backend
	// register plugin
	$REX['ADDON']['page']['my_plugin'] = 'Mein Plugin';
	$REX['ADDON']['version']['my_plugin'] = '1.0.0';
	$REX['ADDON']['author']['my_plugin'] = 'Der Autor';
	$REX['ADDON']['supportpage']['my_plugin'] = 'forum.redaxo.de';
	$REX['ADDON']['description']['my_plugin'] = 'Eine kurze Beschreibung.';

	// add sub page (if needed)
	$REX['ADDON']['be_utilities']['SUBPAGES'][] = array('plugin.my_plugin', $REX['ADDON']['page']['my_plugin']);

	// ...
}
```

Und hier die Anzeige des Beschreibungstext für die `help.inc.php`:

```php
// show plugin description
echo OOPlugin::getProperty('be_utilities', 'my_plugin', 'description');
```

Hinweise
--------

* Getestet mit REDAXO 4.4, 4.5
* AddOn-Ordner lautet: `be_utilities`

Changelog
---------

siehe [CHANGELOG.md](CHANGELOG.md)

Lizenz
------

siehe [LICENSE.md](LICENSE.md)

Credits
-------

* [dergel](https://github.com/dergel) für den META_NAVI EP und das Customizer Plugin
* [gharlan](https://github.com/gharlan) für die Inspiration und den Code für das `articlename_sync` PlugIns
* [joachimdoerr](https://github.com/joachimdoerr) für das `jquery_ui` PlugIn, das hier (in einer modifizierten Version) beigelegt wurde
* [jdlx](https://github.com/jdlx) und die REDAXO-Community für die Hilfe bei der Namensfindung

