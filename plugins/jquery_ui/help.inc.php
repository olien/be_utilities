<?php

/**
 * jQuery UI Plugin
 * 
 * @author mail[at]joachim-doerr[dot]com Joachim Doerr
 *
 * @package redaxo4
 * @version svn:$Id$
 */
 
?>
 
<h2 style="margin-bottom:10px; font-size: 14px;">jQuery UI "be_extensions" Plugin für Redaxo | 21.01.2013 | Ver. 1.3.1</h2>
<h3 style="margin:10px 0 0 0">Systemvoraussetzungen</h3>
<p>jQuery UI ist ein Plugin für das &quot;be_extensions&quot; Addon und kann eingesetzt werden ab Redaxo 4.2 </p>
<h3 style="margin:10px 0 0 0">Installation</h3>
<p>Die installation von jQuery UI ist recht einfach:</p>
<ol style="margin-left:20px;">
<li>Entpacken Sie das Packet und legen Sie dessen Inhalt im Pluginverzeichnis &quot;redaxo/include/addons/be_extensions/plugins/&quot; des &quot;be_extensions&quot; Addons ab.</li>
<li>Installieren und aktivieren Sie das Plugin in Redaxo unter &quot;Addons&quot;. Das Plugin ist in der Addon-Liste als Plugin des &quot;be_extensions&quot; Addons zu finden.</li>
</ol>
<h3 style="margin:10px 0 0 0">Mögliche Fehler und deren Lösung</h3>
<p>Die bis jetzt bekannten Fehler:</p>
<ol style="margin-left:20px;">
<li>Die Installation ist nicht möglich wegen fehlende Schreib- oder Ausführrechte der Ordner
<ul style="margin-left:20px;">
<li>&quot;redaxo/include/addons/be_extensions/plugins/jquery_ui&quot;</li>
<li>&quot;files/addons/be_extensions/plugins&quot;</li>
</ul>
</li>
</ol>
<p>Die Lösung ist jeweils die selbe, prüfen Sie die Berechtigungen der Ordner und erteilen Sie je nach Servereinstellung Rechte von 755 bis 777.</p>
<h3 style="margin:10px 0 0 0">Was macht das jQuery UI Plugin</h3>
<p>Plugin stellt die jQuery UI (User Interface) für Redaxo bereit. Es legt alles nötigen Dateien dafür in dem Ordner &quot;files/addons/be_extensions/plugins/jquery_ui&quot; ab.</p>

<h2 style="margin:10px 0 0 0; font-size: 14px;">Changelog</h2>

<h3 style="margin:10px 0 0 0">Version 1.2.4 by Joachim Doerr</h3>

<h3 style="margin:10px 0 0 0">Version 1.3.0 by WebDevOne</h3>
<ul style="margin-left:20px; margin-top: 0;">
	<li>Update auf jQuery UI Version v1.8.23 (benötigt jQuery 1.6+)</li>
	<li>Theme auf "Aristo" geändert: <a class="extern" href="http://taitems.github.com/Aristo-jQuery-UI-Theme/" target="_blank">http://taitems.github.com/Aristo-jQuery-UI-Theme/</a></li>
	<li>Modul Styles aktualisiert wegen Aristo Theme und in "module" Ordner verschoben</li>
	<li>jquery.cookie.js hinzugefügt: Die Tabs merken sich nun die letzte Position, auch nach einem Pagereload: <a class="extern" href="http://www.blogrammierer.de/jquery-ui-tabs-auswahl-des-richtigen-tabs-bei-reload/" target="_blank">http://www.blogrammierer.de/jquery-ui-tabs-auswahl-des-richtigen-tabs-bei-reload/</a></li>
</ul>

<h3 style="margin:10px 0 0 0">Version 1.3.1 by WebDevOne</h3>
<ul style="margin-left:20px; margin-top: 0;">
	<li>Plugin (vorläufig) für be_extensions AddOn umgebaut</li>
</ul>

<style type="text/css">
a.extern {
	background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAA8CAYAAACq76C9AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFFSURBVHjaYtTpO/CfAQcACCAmBjwAIIAY//9HaNTtP4hiCkAAMeGSAAGAAGJCl7hcaM8IYwMEEBMuCRAACCAmXBIgABBAKA5CBwABhNcrAAGEVxIggPBKAgQQXkmAAMIrCRBAeCUBAgivJEAA4ZUECCC8kgABhFcSIIDwSgIEEF5JgADCKwkQQHglAQIIryRAAOGVBAggvJIAAYRXEiCA8EoCBBBeSYAAwisJEEB4JQECiAVbNoABgADCqxMggPDmMoAAwpvLAAIIby4DCCC8uQwggPDmMoAAwpvLAAIIr1cAAgivJEAA4ZUECCC8kgABhFcSIIDwSgIEEF5JgADCKwkQQHglAQIIryRAAOGVBAggvJIAAYRXEiCA8EoCBBBeSYAAwisJEEB4JQECCK8kQADhlQQIILySAAGEVxIggPBKAgQYAARTLlfrU5G2AAAAAElFTkSuQmCC) no-repeat right 2px;
	padding-right: 10px;
}
</style>
