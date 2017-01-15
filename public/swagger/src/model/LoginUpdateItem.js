(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './Login'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./Login'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.LoginUpdateItem = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.Login);
  }
}(this, function(ApiClient, Login) {
  'use strict';

  /**
   * The LoginUpdateItem model module.
   * @module model/LoginUpdateItem
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>LoginUpdateItem</code>.
   * @alias module:model/LoginUpdateItem
   * @class
   * @param data
   */
  var exports = function(data) {

    this['data'] = data;
  };

  /**
   * Constructs a <code>LoginUpdateItem</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/LoginUpdateItem} obj Optional instance to populate.
   * @return {module:model/LoginUpdateItem} The populated <code>LoginUpdateItem</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('data')) {
        obj['data'] = Login.constructFromObject(data['data']);
      }
    }
    return obj;
  }


  /**
   * @member {module:model/Login} data
   */
  exports.prototype['data'] = undefined;




  return exports;
}));
