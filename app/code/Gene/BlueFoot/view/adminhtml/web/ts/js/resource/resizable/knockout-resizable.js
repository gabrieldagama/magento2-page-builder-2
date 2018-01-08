/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define(["ko", "jquery", 'Gene_BlueFoot/js/component/config'], function (ko, jQuery, Config) {
    'use strict';
    /*eslint-disable */

    var allowedSizes = Config.getInitConfig('column_definitions') || [],
        largestColumn = {breakpoint: 0},
        smallestColumn = {breakpoint: 1},
        largestPercentage,
        smallestPercentage,
        Resizable;

    // Determine the largest and smallest columns
    for (var i = 0; i < allowedSizes.length; i++) {
        if (allowedSizes[i].breakpoint > largestColumn.breakpoint) {
            largestColumn = allowedSizes[i];
        }
        if (allowedSizes[i].breakpoint < smallestColumn.breakpoint) {
            smallestColumn = allowedSizes[i];
        }
    }

    largestPercentage = parseFloat(largestColumn.breakpoint).toFixed(3);
    smallestPercentage = parseFloat(smallestColumn.breakpoint).toFixed(3);

    Resizable = {
        extendedConfig: {},
        currentColumn: null,
        startingWidth: 0,
        startingX: 0,

        init: function (element, extendedConfig) {
            var context = this;

            this.extendedConfig = extendedConfig;

            jQuery(element)
                .on('mousemove', function (event) {
                    var currentElement,
                        ghostWidth,
                        ghost,
                        biggestWidth,
                        smallestWidth;

                    if (!context.currentColumn) {
                        return;
                    }

                    currentElement = jQuery("#" + context.currentColumn.id),
                    ghostWidth = context.startingWidth + (event.clientX - context.startingX),
                    ghost = currentElement.find(".bluefoot-resize-ghost"),
                    biggestWidth = Math.floor(element.parent().outerWidth() * largestPercentage) - 6,
                    smallestWidth = Math.floor(element.parent().outerWidth() * smallestPercentage) - 6;

                    // Stop the ghost width exceeding that of the container
                    if (ghostWidth >= biggestWidth) {
                        ghostWidth = biggestWidth;
                    }
                    if (ghostWidth <= smallestWidth) {
                        ghostWidth = smallestWidth;
                    }

                    ghost.width(ghostWidth);

                    jQuery.each(allowedSizes, function (index, size) {
                        var percentage = parseFloat(size.breakpoint).toFixed(3),
                            breakpoint = Math.floor(element.parent().outerWidth() * percentage);

                        // Stop the loop once we hit a valid breakpoint
                        if (ghostWidth >= breakpoint - 15 && ghostWidth <= breakpoint + 15) {
                            element.find('.bluefoot-resize-size').text(size.label);
                            context.currentColumn.columnDefinition(size);

                            // Force the parent to update it's children
                            context.currentColumn.parent.children.valueHasMutated();
                            return false;
                        }
                    });
                })
                .on('mousedown', extendedConfig.handle, function (event) {
                    context.currentColumn = ko.dataFor(this);
                    context.startingWidth = jQuery(this.parentNode).outerWidth();
                    context.startingX = event.clientX;
                    jQuery(this.parentNode.parentNode).addClass('bluefoot-resizing');
                    jQuery(this.parentNode.parentNode).append(jQuery('<div />').addClass('bluefoot-resize-ghost'));
                    jQuery(this.parentNode.parentNode).find('.element-children').first().append(jQuery('<div />').addClass('bluefoot-resize-size'));

                    // Disable user select on mouse down
                    if (context.currentColumn && typeof context.currentColumn.stage !== 'undefined') {
                        context.currentColumn.stage.userSelect(false);
                    }

                    // If the mouse leaves the window kill the bluefoot resizing functionality
                    jQuery('body').mouseleave(function () {
                        // Disable user select on mouse down
                        if (context.currentColumn && typeof context.currentColumn.stage !== 'undefined') {
                            context.currentColumn.stage.userSelect(true);
                        }

                        context.currentColumn = null;
                        jQuery('.bluefoot-resizing').removeClass('bluefoot-resizing');
                        jQuery('.bluefoot-resize-ghost').fadeOut(200, function () {
                            jQuery(this).remove();
                        });
                        jQuery('.bluefoot-resize-size').fadeOut(200, function () {
                            jQuery(this).remove();
                        });
                    });

                    return true;
                })
                .on('mouseup', function () {
                    // Disable user select on mouse down
                    if (context.currentColumn && typeof context.currentColumn.stage !== 'undefined') {
                        context.currentColumn.stage.userSelect(true);
                    }

                    context.currentColumn = null;
                    jQuery('.bluefoot-resizing').removeClass('bluefoot-resizing');
                    jQuery('.bluefoot-resize-ghost').fadeOut(200, function () {
                        jQuery(this).remove();
                    });
                    jQuery('.bluefoot-resize-size').fadeOut(200, function () {
                        jQuery(this).remove();
                    });
                    return true;
                });
        }
    };

    // Create a new sortable Knockout binding
    ko.bindingHandlers.resizable = {

        /**
         * Init the draggable binding on an element
         *
         * @param element
         * @param valueAccessor
         * @param allBindingsAccessor
         * @param data
         * @param context
         */
        init: function (element, valueAccessor) {
            Resizable.init(element, valueAccessor());
        }

    };
});
