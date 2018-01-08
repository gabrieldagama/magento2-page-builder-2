/*eslint-disable */
define([], function () {
  /**
   * Copyright © Magento, Inc. All rights reserved.
   * See COPYING.txt for license details.
   */
  'use strict';

  var Text =
  /*#__PURE__*/
  function () {
    function Text() {}

    var _proto = Text.prototype;

    /**
     * Read heading type and title from the element
     *
     * @param element HTMLElement
     * @returns {Promise<any>}
     */
    _proto.read = function read(element) {
      return new Promise(function (resolve) {
        resolve({
          'content': element.innerHTML
        });
      });
    };

    return Text;
  }();

  return Text;
});
//# sourceMappingURL=text.js.map
