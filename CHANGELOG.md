Backend Utilities - Changelog
=============================

### Version 1.3.2 - 30. Juli 2014

* AgkSkin Plus: Zusätzlich `max-width: 100%` für Bilder bei den Slice-Inhalten hinzugefügt
* Hide Startarticle: Anpassungen an REDAXO 4.6 vorgenommen

### Version 1.3.1 - 08. Februar 2014

* AgkSkin Plus: Style "Kein Overflow bei den Slice-Inhalten" hinzugefügt
* Einige CSS Updates für Codemirror und Frontend Link

### Version 1.3.0 - 26. Januar 2014

* Codemirror: Update auf Version 3.21, F11 = Fullscreen Mode, Finetuning
* Frontend Link: Name der Website ragt jetzt nicht mehr über das Metamenü rechts hinaus wenn zu lang.
* Frontend Link: Hinweis auf Name und URL der Website unter REDAXO > System.
* Hide Startarticle: PHP Fehler beseitigt wenn Artikel nicht mehr vorhanden
* Hide Startarticle: Es wird jetzt tatsächlich nur der Startartikel versteckt und nicht der erste Artikel in der Kategorie

### Version 1.2.0 - 13. November 2013

* Neues Plugin: AgkSkin Plus (eheml. `agk_skin_mod`) inkl. optionalem Liquid Layout
* Category Seperator: Geht jetzt für alle Sprachen
* Category Seperator: Feste Font-Größe eingestellt
* Article Name Sync reagiert nun auch auf ART_META_UPDATED (bei Änderung des Artikelnames über Metadaten/Sonstiges)

### Version 1.1.0 - 23. September 2013

* Category Seperator: Trennung sollte jetzt zuverlässig laufen und kommt ohne JavaScript aus 
* Hide Startarticle: Jetzt ohne JavaScript
* Hide Startarticle: Wenn Plugin aktiv und REDAXO Setup gestartet kam ein PHP-Fehler
* Codemirror: Vollbildmodus hinzugefügt, CodeMirror auf neuste Version aktualisiert, Neue Themes, Feineinstellungen
* Es wird auf das Customizer Plugin geprüft bei Installation, sowie auf das Website Manager Addon beim Colorizer und Frontend Link Plugin

### Version 1.0.0 - 19. Mai 2013

Erste ofizielle Version mit diesen mitgelieferten Plugins:

* `Articlename Sync` Synchronisiert bei Änderung Kategoriename mit Artikelname und umgekehrt.
* `Category Separator` Erzeugt einen Trenner nach einer angegebenen Kategorie.
* `CodeMirror` Syntax Highlighting für TextAreas (Templates, Module, etc.).
* `Colorizer` Einfärben von REDAXO-Installationen inkl. Colorpicker und cooler automatisch generierter Favicons. 
* `Frontend Link` Fügt ins Menü rechts oben einen Link zum Frontend hinzu.
* `Hide Startarticle` Unbenutzte Startartikel können mit diesem Tool versteckt werden.
* `jQuery UI` jQuery UI inkl. und Aristo Skin und jQuery Cookie Plugin für persistente Tabs.
* `Rex Globals` Einige Tools damit Module und Templates auf globale PHP-Klassen und CSS-Styles zugreifen können.
* `Update Date` Mini Toolkit um das Update Datum der Website zu ermitteln.

