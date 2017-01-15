(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.ResultSuccessMeta = factory(root.UserAdministrationApi.ApiClient);
  }
}(this, function(ApiClient) {
  'use strict';

  /**
   * The ResultSuccessMeta model module.
   * @module model/ResultSuccessMeta
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>ResultSuccessMeta</code>.
   * @alias module:model/ResultSuccessMeta
   * @class
   * @param code
   */
  var exports = function(code) {

    this['code'] = code;

  };

  /**
   * Constructs a <code>ResultSuccessMeta</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/ResultSuccessMeta} obj Optional instance to populate.
   * @return {module:model/ResultSuccessMeta} The populated <code>ResultSuccessMeta</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('code')) {
        obj['code'] = ApiClient.convertToType(data['code'], 'String');
      }
      if (data.hasOwnProperty('title')) {
        obj['title'] = ApiClient.convertToType(data['title'], 'String');
      }
    }
    return obj;
  }


  /**
   * Result code from ApiCodes dictionary
   * @member {String} code
   */
  exports.prototype['code'] = undefined;

  /**
   * Result textual explanation
   * @member {String} title
   */
  exports.prototype['title'] = undefined;




  return exports;
}));
