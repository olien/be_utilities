Backend Erweiterungen [be_extensions] Addon für REDAXO 4
========================================================

Dieses REDAXO-AddOn dient als Container für PlugIns die das Backend erweitern/ergänzen.
Es bietet eine Übersichtseite und für die PlugIns die Möglichkeit eigene Seiten, z.B. für
Einstellungen hinzuzufügen.

Features
--------

* Übersichtsseite mit allen installierten PlugIns
* Jedes PlugIn kann eine eigene Seite haben
* Einfaches Interface zum Andocken der PlugIns an das Addon

Mitgelieferte PlugIns
---------------------

* Cat-Art Name Sync
* Favicon
* Frontend Link
* jQuery UI
* Rex Codemirror
* Rex Module
* Slice Status

PlugIn-Interface
----------------

Ein PlugIn wird in seiner eigenen `config.inc.php` über die Klassen `rex_extension` und `rex_extension_manager` eingebunden:

```php
// add to extension manager
$extension = new rex_extension('plugin_name', 'Titel', 'Eine Beschreibung.', '1.0.0', 'Autor', 'forum.redaxo.de', /* $hasBackendPage = */ true);
$REX['extension_manager']->addExtension($extension);
```

Und so kann in der `help.inc.php` des PlugIns der Beschreibungstext automatisch angezeigt werden:

```php
echo $REX['extension_manager']->getExtension('plugin_name')->getDescription();
```

Hinweise
--------

* Getestet mit REDAXO 4.4.1
* AddOn-Ordner lautet: `be_extensions`
