(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './Phone'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./Phone'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.PhoneUpdateItem = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.Phone);
  }
}(this, function(ApiClient, Phone) {
  'use strict';

  /**
   * The PhoneUpdateItem model module.
   * @module model/PhoneUpdateItem
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>PhoneUpdateItem</code>.
   * @alias module:model/PhoneUpdateItem
   * @class
   * @param data
   */
  var exports = function(data) {

    this['data'] = data;
  };

  /**
   * Constructs a <code>PhoneUpdateItem</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/PhoneUpdateItem} obj Optional instance to populate.
   * @return {module:model/PhoneUpdateItem} The populated <code>PhoneUpdateItem</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('data')) {
        obj['data'] = Phone.constructFromObject(data['data']);
      }
    }
    return obj;
  }


  /**
   * @member {module:model/Phone} data
   */
  exports.prototype['data'] = undefined;




  return exports;
}));
