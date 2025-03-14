# Imgzoom_XH

Imgzoom_XH facilitates presenting very large images (for instance, newspaper
scans) in simple image viewers, so that visitors can view them in full
detail.

- [Requirements](#requirements)
- [Download](#download)
- [Installation](#installation)
- [Settings](#settings)
- [Usage](#usage)
  - [The viewer](#the-viewer)
- [Troubleshooting](#troubleshooting)
- [License](#license)
- [Credits](#credits)

## Requirements

Imgzoom_XH is a plugin for [CMSimple_XH](https://www.cmsimple-xh.org/).
It requires PHP ≥ 7.1.0 and CMSimple_XH ≥ 1.7.0.
Imgzoom_XH also requires the [Plib_XH](https://github.com/cmb69/plib_xh) plugin;
if that is not already installed (see *Settings*→*Info*),
get the [lastest release](https://github.com/cmb69/plib_xh/releases/latest),
and install it.

## Download

The [lastest release](https://github.com/cmb69/imgzoom_xh/releases/latest)
is available for download on Github.

# Installation

The installation is done as with many other CMSimple_XH plugins.

1. Backup the data on your server.
1. Unzip the distribution on your computer.
1. Upload the whole directory `imgzoom/` to your server into
   the `plugins/` directory of CMSimple_XH.
1. Set write permissions for the subdirectories `css/` and `languages/`.
1. Navigate to `Plugins` → `Imgzoom` in the back-end to check
   if all requirements are fulfilled.

## Settings

The configuration of the plugin is done as with many other CMSimple_XH plugins
in the back-end of the Website. Go to `Plugins` → `Imgzoom`.

Localization is done under `Language`. You can translate the character
strings to your own language (if there is no appropriate language file
available), or customize them according to your needs.

The look of Imgzoom_XH can be customized under `Stylesheet`.

## Usage


Images that shall be displayed in an Imgzoom_XH viewer have to be placed in
the image folder of CMSimple_XH (usually `userfiles/images/`) or
in a subfolder thereof.

You can either link to the image viewer from the content or the template,
or you can embed it in an Iframe.
However, in either case you do not use the URL of the image directly,
but instead request the image viewer:

    ./?&imgzoom_image=%IMAGE_FILENAME%

An example: say you have the file `userfiles/images/scan.jpg`.
To create a link, use the following URL:

    ./?&imgzoom_image=scan.jpg

To embed an image viewer in a page write the following in HTML mode:

    <iframe src="./?&imgzoom_image=scan.jpg" frameborder="0" width="500" height="500"></iframe>

Adjust `width` and `height` according to your needs.

If the image to display is in a subfolder of the image folder, you have to
add the subfolder in the URL, for instance:

    ./?&imgzoom_image=scans/image.jpg

### The viewer

On contemporary desktop browsers with JavaScript support the image will be
resized to be shown completely when the image viewer is displayed.
To zoom in, you have to click on the desired place;
to zoom-out simply press the `SHIFT` key while clicking.

On older browsers and on browsers without JavaScript support the image will
be displayed in its full size.
You have to scroll to the desired section of the image.
Zooming can be done with the controls of the browser for stand-alone viewers.

On mobile browsers you can use the customary pan, pinch-to-zoom and double
tap gestures.
Zooming will not generally work for embedded viewers,
besides zoom-in with a long press.

## Troubleshooting

Report bugs and ask for support either on [Github](https://github.com/cmb69/imgzoom_xh/issues)
or in the [CMSimple_XH Forum](https://cmsimpleforum.com/).

## License

Imgzoom_XH is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published
by the Free Software Foundation, either version 3 of the License,
or (at your option) any later version.

Imgzoom_XH is distributed in the hope that it will be useful,
but without any warranty; without even the implied warranty of merchantibility
or fitness for a particular purpose.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Imgzoom_XH. If not, see https://www.gnu.org/licenses/.

Copyright © Christoph M. Becker

## Credits

Imgzoom_XH has been inspired by *Korvell*.

The plugin logo is designed by [Alessandro Rei](http://www.mentalrey.it/).
Many thanks for publishing this icon under GPL.

Many thanks to the community at the [CMSimple_XH forum](https://www.cmsimpleforum.com/)
for tips, suggestions and testing.

And last but not least many thanks to [Peter Harteg](https://www.harteg.dk/),
the “father” of CMSimple, and all developers of [CMSimple_XH](https://www.cmsimple-xh.org/)
without whom this amazing CMS would not exist.
