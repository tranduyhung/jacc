<?php

// no direct access
defined('_JEXEC') or die('Restricted access');



$style = "
div.yacc table { 
	border-collapse: collapse;
	}
div.yacc table, div.yacc  td, div.yacc  th {
    border: 1px solid #BBBBBB;
    padding: 4px;
}
.yacc dl.tabs {
	float: left;
	margin: 10px 0 -1px 0;
	
	z-index: 50;
}

.yacc dl.tabs dt {
	float: left;
	padding: 4px 10px;
	border: 1px solid #ccc;
	margin-left: 3px;
	background: #e9e9e9;
	color: #666;
}

.yacc dl.tabs dt.open {
	background: #F9F9F9;
	border-bottom: 1px solid #f9f9f9;
	z-index: 100;
	color: #000;
}

.yacc div.current {
	clear: both;
	border: 1px solid #ccc;
	padding: 10px 10px;
}

.yacc div.current dd {
	padding: 0;
	margin: 0;
}
.yacc dl.tabs h3{
	font-size:1.0em;
}
.yacc  dl#content-pane.tabs {
	margin: 1px 0 0 0;
}
";
$document = JFactory::getDocument();
$document->addStyleDeclaration($style);

?>
<div  style="font-size:1.1em" class="nav-tabs yacc col <?php if(version_compare(JVERSION,'3.0','lt')): ?>width-50  <?php endif;?>span8  fltlft">

<?php echo JHtml::_('tabs.start','howto-1');?> 
<?php echo JHtml::_('tabs.panel', 'Einführung','howto-1-intro'); ?>

<h2>Jacc ist...</h2>
<p><strong>J</strong>ust <strong>a</strong>nother <strong>c</strong>omponent <strong>c</strong>reator</p>
<h2>Vorgehen</h2>
<p>Bevor die erste Zeile Code geschrieben ist, muss ein Datenmodell entwickelt werden. Normalerweise wird dieses Modell später in der Datenbank abgebildet.</p> 
<p>Ich z.B. verwende MySQL Workbench für die Entwicklung des Datenmodells. Das Tool ist in der Lage, Tabellen direkt in eine Datenbank exportieren.</p>
<p><strong>Jacc</strong> verwendet diese Tabellen, und erwartet, dass jede Tabelle (soweit ein Primärschlüssel vorhanden ist) ein Triple eines Model View Controls repräsentiert.</p>
<p>
	Stelle also vor dem Einsatz von <strong>Jacc</strong> sicher, dass in der Joomla Datenbank Tabellen vorhanden sind, die dein Datenmodell wiedergeben.
	Für einen kleinen Test kannst du das <a class='modal' href="<?php echo JRoute::_('index.php?option=com_jacc&view=sql&tmpl=component') ?>"  rel="{handler: 'iframe', size: {x: 650, y: 475}}">Beispiel-SQl für einen Buchladen</a> ausprobieren.
</p>
<h2>Quick Start</h2>
	<ol>
		<li>Importiere deine Tabellen in die Joomla Datenbank</li>
		<li>Wähle <strong>Jacc-&gt;Komponenten</strong> und konfiguriere die <strong>Optionen</strong>.</li>
		<li>Klicke auf <strong>Neu</strong>. Der Jacc Komponenten-Editor wird angezeigt.</li>
		<li>Erfasse Titel und Version, wähle deine Tabellen und klicke auf <strong>Speichern</strong>. Deine Komponente erscheint nun in der Komponentenliste.</li>
		<li>Kopiere den Link in der Spalte  <strong>Download</strong>, gib ihn im URL-Feld des <strong>Joomla Installations-Managers</strong> ein und installiere die Komponente.</li>
	</ol>
<p>
	Wenn du die vorgeschlagenen Namenskonventionen für die Tabellenspalten eingehalten hast, wirst du eine funktionierendes, aber rudimentäres Backend und Frontend für die Komponente bekommen. Du kannst nun mit der Entwicklung starten. 	
</p>		

<?php echo JHtml::_('tabs.panel', 'Richtlinien','howto-1-guidlines'); ?>		

<h2>Richtlinien und Empfehlungen</h2>

<h3>Tabellen Naming</h3>
<p>Verwende einen Unterstrich zur Darstellung der Beziehung zwischen Tabellen. Zum Beispiel bei der Entwicklung der Buchladen-Komponente:</p>
<p><strong>jos_book</strong> (Die Hauptansicht/Die Bücher), <strong>jos_book_author (Autoren)</strong>,  <strong>jos_book_publisher (Verlage)</strong> etc..</p>
<h3>Tabellen Feldnamen</h3>
<strong>Jacc</strong> erkennt einige Felder als Standard Felder für Joomla:
<ul>
	<li><strong>title</strong> (varchar) <br /> oder<br /><strong>name</strong> (varchar)</li>
	<li><strong>alias</strong> (varchar)</li>
	<li><strong>description</strong> (text)</li>
	<li><strong>catid</strong> Kategorie (int)<br /> or<br /><strong>category_id</strong> (int)</li>	
</ul> 
<p>
	Wenn du diese Standardnamen verwendest, wird <strong>Jacc</strong> automatisch die richtigen Elemente für Backend Formulare und Listenansichten erzeugen.	   
</p>
<p>Eine vollständige Liste der speziellen Feldnamen und ihre Resultate findest du im Reiter <strong>Tabellen-Optimierung</strong></p>
<p>
	Empfehlung: Benenne Primärschlüssel mit <strong>id</strong>
</p>
<h3>Fremdschlüssel</h3>
<p><strong>Jacc</strong> wird Fremdschlüssel in deinen Tabellen erkennen, wenn du die Regeln fürs Naming berücksichtigst.</p>
<h5>Beispiel:</h5>
<p>
	Tabellen: <i>jos_example, jos_example_some, jos_example_foo</i>
</p>
<p>	
	Fremdschlüssel müssen lauten: <i>some_id, foo_id, example_id</i>
</p> 
<p>Wenn du also ein Feld some_id in der Tabelle jos_example verwendest, wird in der "Example"-Detailansicht im Backend ein Auswahlfeld erzeugt, das die Einträge aus der Tabelle jos_example_some auflistet.</p>
<h3>Formulare</h3>
<p>Eine der Neuerungen in Joomla 2.5, 3.x ist die <strong>Forms</strong>-Bibliothek, die von <strong>Jacc</strong> unterstützt wird.</p>
<p>
	Die Formulare werden durch eine XML-Datei in models/forms definiert. Werfe einen Blick auf  libraries/joomla/form/fields um einen Eindruck von den verfügbaren Feld-Typen zu erhalten. Mehr Information unter <a href="http://docs.joomla.org/Developers">docs.joomla.org/Developers</a>
</p>
<h2>Kategorien</h2>
<p>Die Option <strong><?php echo JText::_('PARAMS_CATEGORIES_LABEL')?></strong> fügt deiner Komponente hierarchisch gegliederte Kategorien hinzu.</p>
<h2>Einschränlungen </h2>
<ul>
<li>Ein Frontend-View wird nur die Inhalte der Tabellenfelder auflisten. Du kannst dir sicher vorstellen, dass <strong>Jacc</strong> nicht in der Lage ist, den Zweck deiner Komponente zu erraten.</li>
<li>Es wird keine SQL-Joins in den Frontend-Models auf die Fremdschlüssel geben. Das musst du selbst erledigen.</li>
<li><strong>Jacc</strong> wird nicht funktionieren, wenn du für deine Joomla-Installation einen Tabellen-Prefix gewählt hast, der nicht mit einem Unterstrich endet (wie bei jos_)</li>
</ul>
<?php echo JHtml::_('tabs.panel', 'Entwickeln','howto-1-developing'); ?>

<p>Bei der Entwicklung mit Jacc wird folgende Vorgehensweise vorgeschlagen:</p>


	<ol>
	<li>Installiere <strong>Jacc</strong> in einem Joomla, das du als Entwicklungsumgebung verwendest.</li>
		<li>Entwickle ein Datensystem und und setze es in MySQL-Tabellen um.</li>

		<li>Importiere dann die Tabellen-Struktur in das Joomla auf dem du <strong>Jacc</strong> installiert hast.</li>
		<li>Erzeuge eine Komponente und installiere sie im selben Joomla.</li>
		<li>Konfiguriere <strong>Maximum</strong> für das Joomla Error-Reporting und führe einen Test durch, ob das Speichern fon Einträgen im Komponenten-Backend funktioniert.</li>
		<li>Ist dies nicht der Fall, prüfe das Naming deiner Tabellen-Felder (typische Fehler ist ein vergessenes Autoincrement für die id oder das Fehlen eines Primärschlüssels).</li>

		<li>Wenn die Tabellenstruktur zufriedenstellend ist, kannst du die Komponente erneut generieren und installieren.</li>
		<li>Aktiviere die Option "Live Komponente"  im Jacc-Komponenten-Editor um Installtionspakete aus der installierten Komponente zu erzeugen. (Beachte dabei, dass Änderungen an der Tabellenstruktur nicht die gewünschten Ergebnisse haben werden, da bereits bestehende Views, Models, Controllers nicht überschrieben werden).</li>
	</ol>


	<p>Nun kannst du die Komponente "vor Ort" weiterentwickeln und <strong>Jacc</strong> verwenden um Installations-Pakete zu erzeugen.</p>
<?php echo JHtml::_('tabs.panel', 'Tabellen optimieren','howto-1-tables'); ?>
	
<p>Du kannst den vollen Nutzen aus den Fähigkeiten von YACC ziehen, wenn du einige Regeln bei der Benennung der Tabellen-Felder befolgst:</p>


	<table class="yacctable">
		<tr>

			<td><strong>Feldname</strong></td>
			<td>     <strong>Alternativen</strong>     </td>
			<td><strong>Feld Typ</strong>     </td>
			<td><strong>Kommentar</strong></td>
		</tr>

		<tr>
			<td><strong><em>id</em></strong> </td>
			<td>Jeder Primärschlüssel</td>
			<td>    hidden field     </td>
			<td>Dieses Feld muss als Fremdschlüssel und Autoincrement gekennzeichnet sein. Jeder andere Feld-Name wird akzeptiert, jedoch ist "id" Joomla-konform.</td>
		</tr>

		<tr>
			<td><strong><em>title</em></strong> </td>
			<td>    name, sku </td>
			<td>    text field </td>
			<td>In 99% aller Fälle gibt es so etwas wie einen Namen oder Titel für einen Eintrag, also einen für Menschen verständlichen Bezeichner. Falls keiner der aufgeführten Feldnamen für deine Tabelle zutrifft, dann positioniere ein Varchar-Feld direkt nach dem Fremdschlüssel (id)</td>

		</tr>
		<tr>
			<td><strong><em>alias</em></strong> </td>
			<td>    Keine </td>
			<td>    text field </td>
			<td>    Das Alias-Feld wird verwendet um SEF-Urls für Einträge zu erzeugen</td>

		</tr>
		<tr>
			<td><strong><em>params</em></strong> </td>
			<td>    Keine </td>
			<td>    Keine </td>
			<td>    Ermöglicht die Verwendung von Parametern. Sie können einfach implementiert werden, indem Felder im Formular-XML in der Parameter-Feld-Gruppe hinzugefügt werden.</td>

		</tr>
		<tr>
			<td><strong><em>ordering</em></strong> </td>
			<td>    Keine </td>
			<td>    System </td>
			<td>    Die Verwendung ermöglicht die Sortierung von Einträgen im Backend.</td>

		</tr>
		<tr>
			<td><strong><em>published</em></strong> </td>
			<td>    state </td>
			<td>    Status-Select </td>
			<td>    Die Verwendung ist sehr empfohlen, um Einträge ein- und ausblenden zu können.</td>

		</tr>
		<tr>
			<td><strong><em>access</em></strong> </td>
			<td>    Keine </td>
			<td>    Zugriffsebene-Select </td>
		</tr>

		<tr>
			<td><strong><em>category_id</em></strong> </td>
			<td>    catid     </td>
			<td>Kategorien-Select </td>
			<td>    Damit dies funktioniert muss natürlich "Kategorien Verwenen" aktiviert sein.</td>

		</tr>
		<tr>
			<td><strong><em>parent_id</em></strong> </td>
			<td>    parentid </td>
			<td>    Selevt </td>
			<td>    Damit kannst du einen Eintrag im Backend mit einem Eltern-Eintrag verknüpfen. Im Frontend musst du das natürlich selbst implementieren</td>

		</tr>
		<tr>
			<td><strong><em>description</em></strong> </td>
			<td>    text </td>
			<td>    editor </td>
			<td> Jedes Feld diesen Typs wird im Backend-Formular auch ein Editorfeld erzeugen.</td>

		</tr>
		<tr>
			<td><strong><em>language</em></strong> </td>
			<td>    Keine </td>
			<td>    Sprachauswahl </td>
			<td> </td>

		</tr>
		<tr>
			<td><strong><em>created</em></strong> </td>
			<td>    created_time </td>
			<td>    Kalender </td>
			<td>Wenn kein Eintrag vorgenommen wird, wird automatisch das aktuelle Datum für den Eintrag verwendet.</td>

		</tr>
		<tr>
			<td><strong><em>created_by</em></strong> </td>
			<td>    Keine</td>
			<td>    Text </td>
			<td>    Der Name des aktuellen Benutzers</td>

		</tr>
		<tr>
			<td><strong><em>created_by_alias</em></strong> </td>
			<td>    Keine </td>
			<td>    Text</td>
			<td>    TODO: Make it a text field</td>

		</tr>
		<tr>
			<td><strong><em>modified</em></strong> </td>
			<td>    Keine </td>
			<td>    Printed text. </td>
			<td>    Will be autosaved.</td>

		</tr>
		<tr>
			<td><strong><em>modified_by</em></strong> </td>
			<td>    Keine</td>
			<td>    Text. </td>
			<td>    Will be autosaved.</td>

		</tr>
		<tr>
			<td><strong><em>checked_out</em></strong> </td>
			<td>    checked_out_time </td>
			<td>    System </td>
			<td> Will be autosaved.</td>

		</tr>
		<tr>
			<td><strong><em>checked_out_by</em></strong> </td>
			<td>    Keine </td>
			<td>    System </td>
			<td>    Will be autosaved.</td>

		</tr>
		<tr>
			<td><strong><em>publish_up</em></strong> </td>
			<td>    Keine</td>
			<td>    Kalender </td>
			<td>    Bisher nicht im Frontend implementiert</td>

		</tr>
		<tr>
			<td><strong><em>publish_down</em></strong> </td>
			<td>    Keine</td>
			<td>    Kalender </td>
			<td>    Bisher nicht im Frontend implementiert</td>

		</tr>
		<tr>
			<td><strong><em>image</em></strong> </td>
			<td>    Keine </td>
			<td>    Imageup </td>
			<td>    Stellt eine Bild-Upload-Funktion zur Verfügung, bei der automatisch Thumbnails erzeugt werden</td>

		</tr>		
	</table>
<?php echo JHtml::_('tabs.panel', 'Kompatibilität','howto-1-compat'); ?>

<p>Die Beispiels-Komponente wurde unter Joomla 2.5, 3.1 getestet</p>
<h2>Jacc Weiterentwickeln</h2>
<p>Wenn du <strong>Jacc</strong> deinem eigenen Programmier-Stil anpassen willst, kannst du vorsichtig die Dateien in <strong>com_jacc/templates</strong> bearbeiten. </p>
<p>Templates im Ordner <strong>mvcbase</strong> sind gebräuchliche Klassen, die nur wenige Änderungen benötigen. Die im Ordner<strong>mvctriple</strong> werden für deine Komponente und dein Datenmodell stärker spezialisiert. 
	   Es gibt dort eine Menge Platzhalter. Vermutlich wirst du leicht verstehen wozu sie dienen.

<?php echo JHtml::_('tabs.panel', 'Subversion','howto-1-subversion'); ?>

<p>Das Folgende Verfahren wird vom Autor erfolgreich angewandt:</p>


	<h3 id="Prerequisite">Vorraussetzung:</h3>


	<p>Das Entwicklungs-System (Joomla) ist unter Versionskontrolle.</p>


	<h3 id="Procedure">Vorgehen:</h3>


	<ol>
	<li>Erzeuge und installiere die Komponente.</li>
		<li>Entpacke das Installationspaket in einen Ordner und füge es via "svn import" dem trunk des Repository hinzu.</li>
		<li>Lösche im Joomla das Backend und Frontend der Komponente.</li>

		<li>Registriere unter dem Ordner administrator/components "trunk/admin" als external: <br>  <pre>svn propset svn:externals com_mycomponent http://svn.mydomain.tld/repository/trunk/admin components</pre></li>
		<li>Registriere im Ordner components "trunk/site" als external</li>
	</ol>


	<p>Bei jedem Commit wird nun aiuch das Repository der Komponente upgedatet</p>

<?php echo JHtml::_('tabs.end');?>
</div>
<div class="col <?php if(version_compare(JVERSION,'3.0','lt')): ?>width-40  <?php endif;?>span2 fltrt">
<fieldset class="adminform">
	<legend>About</legend>
	<strong>Autor:</strong> Michael Liebler<br />
	<strong>Home:</strong> <a href="http://www.janguo.de">www.janguo.de</a><br />
	<strong>Lizens:</strong> <a href="http://www.gnu.org/licenses/gpl-2.0.html">http://www.gnu.org/licenses/gpl-2.0.html</a>  GNU/GPL<br />		
	<strong>Forum/Feature Request</strong>: <a href="http://redmine.janguo.de/projects/jacc/">redmine.janguo.de/projects/jacc/</a> (registration required)	
</fieldset>
<fieldset class="adminform">
	<legend>Unterstütze andere Benutzer</legend>
	<p>Unterstütze andere Benutzer indem du deine Erfahrungen mit <strong>Jacc</strong>  auf <a href="http://extensions.joomla.org/extensions/miscellaneous/development/13644">extensions.joomla.org</a> weitergibst.
</fieldset>
<fieldset class="adminform">
	<legend>Make a Donation</legend>
					<table>
	<tr>	
		<td align="center">
			Wenn dir <strong>Jacc</strong> nützlich war, dann mache uns doch eine kleine Spende um die Weiterentwicklung zu untestützen. Herzlichen Dank.</td>
	</tr>
	<tr>
		<td align="center">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
			<input type="hidden" name="cmd" value="_donations">

			<input type="hidden" name="business" value="michael-liebler@janguo.de">
			<input type="hidden" name="item_name" value="">
			<input type="hidden" name="amount" value="">
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="currency_code" value="EUR">
			<input type="hidden" name="tax" value="0">
			<input type="hidden" name="lc" value="DE">
			<input type="hidden" name="bn" value="PP-DonationsBF">
			<input type="image" src="http://wzcreativetechnology.com/paypal/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>	
		</td>
	</tr>
</table>
</fieldset>

</div>
<form method="post" action="index.php?option=com_jacc" id="adminForm" name="adminForm">
		<input type="hidden" name="option" value="com_jacc" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="jacc" />	
		<?php echo JHTML::_( 'form.token' ); ?>
</form>
<div class="clr"></div>
<div style="text-align:center;font-weight:bold;padding:10px;clear:both">Jacc Version <?php print JaccHelper::getVersion() ?></div> 
