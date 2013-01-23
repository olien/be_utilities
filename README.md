Backend Erweiterungen [be_extensions] Addon für REDAXO 4
========================================================

Dieses REDAXO-AddOn dient als Container für PlugIns die das Backend erweitern/ergänzen.
Es bietet eine Übersichtseite und für die PlugIns die Möglichkeit eigene Seiten, z.B. für
Einstellungen hinzuzufügen.

Features
--------

* Übersichtsseite mit allen installierten PlugIns
* Jedes PlugIn kann eine eigene Seite haben
* Vereinfachte Einbindung der PlugIns möglich

Screenshots
-----------

Übersichtseite: https://www.dropbox.com/s/4i47xxmu8gyokk4/be_extensions.png

Mitgelieferte PlugIns
---------------------

* `Cat-Art Name Sync` Synchronisiert bei Änderung Kategoriename mit Artikelname und umgekehrt.
* `Favicon` Ein Favicon fürs Backend.
* `Frontend Link` Fügt ins Menü rechts oben einen Link zum Frontend hinzu.
* `jQuery UI` jQuery UI inkl. jQuery Cookie Plugin und Aristo Skin.
* `Rex Codemirror` Syntax Highlighting für TextAreas (Templates, Module, etc.).
* `Rex Module` Einige Tools damit Module auf globale Variablen, Methoden und Styles zugreifen können.
* `Slice Status` Fügt einen On/Offline-Schalter für Blöcke (Slices) hinzu.

Weitere PlugIns
---------------

Hier werden in Zukunft weitere PlugIns für das AddOn gelistet werden.

Vereinfachte Einbindung eines PlugIns
-------------------------------------

Ein PlugIn kann ganz einfach in der `config.inc.php` des PlugIns eingebunden werden:

```php
// register plugin
rex_plugin_factory::registerPlugin('be_extensions', 'my_plugin', 'Mein Plugin', 'Eine kurze Beschreibung.', '1.0.0', 'Der Autor', 'forum.redaxo.de', /* $hasBackendPage = */ true, /* $permission = '' */);
```

In der `help.inc.php` des PlugIns lässt sich der Beschreibungstext so angezeigen:

```php
// show plugin description
echo rex_plugin_factory::getPluginDescription('be_extensions', 'my_plugin');
```

Klassische Einbindung eines PlugIns
-----------------------------------

Alternativ lässt sich ein PlugIn auch wie gewohnt einbinden:

```php
// register plugin
$REX['ADDON']['page']['my_plugin'] = 'Mein Plugin';
$REX['ADDON']['version']['my_plugin'] = '1.0.0';
$REX['ADDON']['author']['my_plugin'] = 'Der Autor';
$REX['ADDON']['supportpage']['my_plugin'] = 'forum.redaxo.de';
$REX['ADDON']['description']['my_plugin'] = 'Eine kurze Beschreibung.';

// add sub page (if needed)
$REX['ADDON']['be_extensions']['SUBPAGES'][] = array('plugin.my_plugin', $REX['ADDON']['page']['my_plugin']);
```

Und hier die Anzeige des Beschreibungstext für die `help.inc.php`:

```php
// show plugin description
echo OOPlugin::getProperty('be_extensions', 'my_plugin', 'description');
```

Hinweise
--------

* Getestet mit REDAXO 4.4.1
* AddOn-Ordner lautet: `be_extensions`

Ein herzliches Dankeschön geht an:
----------------------------------

* [gharlan](https://github.com/gharlan) für die Inspiration und den Code ;) für das `cat_art_name_sync` PlugIns
* [jdlx](https://github.com/jdlx) für das `rex_codemirror` Plugin, dass nun hier beigelegt wurde
* [joachimdoerr](https://github.com/joachimdoerr) für das `jquery_ui` Plugin, das hier (in einer modifizierten Version) beigelegt wurde

