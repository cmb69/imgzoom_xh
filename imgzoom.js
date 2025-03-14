/*
 * Copyright (c) Christoph M. Becker
 *
 * This file is part of Imgzoom_XH.
 *
 * Imgzoom_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Imgzoom_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Imgzoom_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

addEventListener("load", function () {

    var image, imageRatio, baseWidth, baseHeight, zoomFactor;

    function shrinkImage() {
        image.width = 1;
        image.height = 1;
    }

    function fitImageToViewport() {
        var viewport = document.documentElement,
            viewportWidth = viewport.clientWidth,
            viewportHeight = viewport.clientHeight,
            viewportRatio = viewportWidth / viewportHeight;
        if (imageRatio >= viewportRatio) {
            baseWidth = viewportWidth;
            baseHeight = baseWidth / imageRatio;
        } else {
            baseHeight = viewportHeight;
            baseWidth = baseHeight * imageRatio;
        }
        image.width = Math.floor(baseWidth);
        image.height = Math.floor(baseHeight);
    }

    function onChange() {
        image.width = baseWidth * Math.pow(2, zoomFactor / 2);
        image.height = baseHeight * Math.pow(2, zoomFactor / 2);
    }

    function onClick(event) {
        var imageX, imageY, horzPercentage, vertPercentage,
            zoom, docEl, hiddenWidth, hiddenHeight;
        imageX = event.pageX - image.offsetLeft;
        imageY = event.pageY - image.offsetTop;
        horzPercentage = imageX / image.width;
        vertPercentage = imageY / image.height;
        zoom = event.shiftKey ? -Math.sqrt(2) : Math.sqrt(2);
        zoomFactor += zoom;
        zoomFactor = Math.max(zoomFactor, 0);
        zoomFactor = Math.min(zoomFactor, 8);
        onChange();
        docEl = document.documentElement;
        hiddenWidth = docEl.scrollWidth - docEl.clientWidth;
        hiddenHeight = docEl.scrollHeight - docEl.clientHeight;
        window.scrollTo(horzPercentage * hiddenWidth, vertPercentage * hiddenHeight);
    }

    zoomFactor = 0;
    image = document.images[0];
    imageRatio = image.offsetWidth / image.offsetHeight;
    image.addEventListener("click", onClick);
    shrinkImage();
    fitImageToViewport();
    addEventListener("keydown", function (event) {
        if (event.shiftKey) {
            image.className = "imgzoom_out";
        }
    });
    addEventListener("keyup", function () {
        image.className = "";
    });
    addEventListener("resize", function () {
        shrinkImage();
        fitImageToViewport();
    });
});
