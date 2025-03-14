# Imgzoom_XH

Imgzoom_XH ermöglicht die Präsentation sehr großer Bilder (z.B.
Zeitungsscans) in einfachen Bildbetrachtern, so dass Besucher sie in
allen Details ansehen können.

- [Voraussetzungen](#voraussetzungen)
- [Download](#download)
- [Installation](#installation)
- [Einstellungen](#einstellungen)
- [Verwendung](#verwendung)
  - [Der Viewer](#der-viewer)
- [Problembehebung](#problembehebung)
- [Lizenz](#lizenz)
- [Danksagung](#danksagung)

## Voraussetzungen

Imgzoom_XH ist ein Plugin für [CMSimple_XH](https://www.cmsimple-xh.org/de/).
Es benötigt PHP ≥ 7.1.0 und CMSimple_XH ≥ 1.7.0.
Imgzoom_XH benötigt weiterhin das [Plib_XH](https://github.com/cmb69/plib_xh) Plugin;
ist dieses noch nicht installiert (see *Einstellungen*→*Info*),
laden Sie das [aktuelle Release](https://github.com/cmb69/plib_xh/releases/latest)
herunter, und installieren Sie es.

## Download

Das [aktuelle Release](https://github.com/cmb69/imgzoom_xh/releases/latest)
kann von Github herunter geladen werden.

## Installation

Die Installation erfolgt wie bei vielen anderen CMSimple_XH-Plugins auch.

1. Sichern Sie die Daten auf Ihrem Server.
1. Entpacken Sie das herunter geladene Archiv auf Ihrem Computer.
1. Laden Sie das komplette Verzeichnis `imgzoom/` auf Ihren Server in
   das Pluginverzeichnis (`plugins/`) von CMSimple_XH.
1. Machen Sie die Unterverzeichnisse `css/` und `languages/` beschreibbar.
1. Browsen Sie zu `Plugins` → `Imgzoom` im Administrationsbereich,
   um zu prüfen, ob alle Voraussetzungen erfüllt sind.

## Einstellungen


Die Konfiguration des Plugins erfolgt wie bei vielen anderen
CMSimple_XH-Plugins auch im Administrationsbereich der Homepage.
Gehen Sie zu `Plugins` → `Imgzoom`.

Die Lokalisierung wird unter `Sprache` vorgenommen. Sie können dort die
Sprachtexte in Ihre eigene Sprache übersetzen (falls keine entsprechende
Sprachdatei zur Verfügung steht), oder diese gemäß Ihren Wünschen anpassen.

Das Aussehen von Imgzoom_XH kann unter `Stylesheet` angepasst werden.

## Verwendung

Bilder, die in einem Imgzoom_XH Viewer angezeigt werden sollen, müssen im
Bilderordner von CMSimple_XH (normalerweise `userfiles/images/`)
oder in einem Unterordner von diesem abgelegt werden.

Sie können entweder den Image-Viewer auf einer Seite oder im Template
verlinken, oder ihn in einem Iframe einbetten.
In beiden Fällen verwenden Sie allerdings nicht direkt die URL des Bildes,
sondern fordern den Image-Viewer an:

    ./?&imgzoom_image=%DATEINAME_DES_BILDES%

Zum Beispiel: angenommen Sie haben die Datei `userfiles/images/scan.jpg`.
Um einen Link zu erzeugen, verwenden Sie folgende URL:

    ./?&imgzoom_image=scan.jpg

Um einen Bildbetrachter auf einer Seite einzubetten,
schreiben Sie folgendes im HTML-Modus:

    <iframe src="./?&imgzoom_image=scan.jpg" frameborder="0" width="500" height="500"></iframe>

Passen Sie `width` und `height` gemäß Ihren Anforderungen an.

Befindet sich das anzuzeigende Bild in einem Unterordner des Bildordners,
dann muss dieser in der URL angegeben werden, z.B.:

    ./?&imgzoom_image=scans/bild.jpg

### Der Viewer

In zeitgemäßen Desktop-Browsern mit JavaScript-Unterstützung wird das Bild
skaliert, so dass es im Viewer zunächst vollständig sichtbar ist.
Zum Hereinzoomen klicken Sie auf die gewünschte Stelle;
zum Herauszoomen halten Sie die `UMSCHALT`-Taste gedrückt, während Sie klicken.

In älteren Browsern und in Browsern ohne JavaScript-Unterstützung
wird das Bild in seiner vollen Größe angezeigt.
Sie müssen zum gewünschten Bildausschnitt scrollen.
Zoomen kann bei eigenständigen Viewern über die
entsprechende Browserfunktion durchgeführt werden.

In mobilen Browsern können Sie die üblichen Gesten zum Schwenken und Zoomen
verwenden.
Allgemeines Zoomen ist bei eingebetten Viewern nicht möglich,
außer dem Heranzoomen durch längeres Drücken der gewünschten Stelle.

## Problembehebung

Melden Sie Programmfehler und stellen Sie Supportanfragen entweder auf
[Github](https://github.com/cmb69/imgzoom_xh/issues)
oder im [CMSimple_XH Forum](https://cmsimpleforum.com/).

## Lizenz

Imgzoom_XH ist freie Software. Sie können es unter den Bedingungen
der GNU General Public License, wie von der Free Software Foundation
veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß
Version 3 der Lizenz oder (nach Ihrer Option) jeder späteren Version.

Die Veröffentlichung von Imgzoom_XH erfolgt in der Hoffnung, daß es
Ihnen von Nutzen sein wird, aber *ohne irgendeine Garantie*, sogar ohne
die implizite Garantie der *Marktreife* oder der *Verwendbarkeit für einen
bestimmten Zweck*. Details finden Sie in der GNU General Public License.

Sie sollten ein Exemplar der GNU General Public License zusammen mit
Imgzoom_XH erhalten haben. Falls nicht, siehe <https://www.gnu.org/licenses/>.

Copyright © Christoph M. Becker

## Danksagung

Dieses Plugin wurde von *Korvell* angeregt.

Das Pluginlogo wurde von [Alessandro Rei](http://www.mentalrey.it/) gestaltet.
Vielen Dank für die Veröffentlichung unter GPL.

Vielen Dank an die Gemeinschaft im [CMSimple_XH-Forum](https://www.cmsimpleforum.com/)
für Tipps, Anregungen und das Testen.

Und zu guter letzt vielen Dank an [Peter Harteg](https://www.harteg.dk/),
den „Vater“ von CMSimple, und allen Entwicklern von
[CMSimple_XH](https://www.cmsimple-xh.org/de/) ohne die es dieses
phantastische CMS nicht gäbe.
