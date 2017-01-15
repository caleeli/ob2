(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './Error'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./Error'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.ErrorArray = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.Error);
  }
}(this, function(ApiClient, Error) {
  'use strict';

  /**
   * The ErrorArray model module.
   * @module model/ErrorArray
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>ErrorArray</code>.
   * @alias module:model/ErrorArray
   * @class
   * @param errors
   */
  var exports = function(errors) {

    this['errors'] = errors;
  };

  /**
   * Constructs a <code>ErrorArray</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/ErrorArray} obj Optional instance to populate.
   * @return {module:model/ErrorArray} The populated <code>ErrorArray</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('errors')) {
        obj['errors'] = ApiClient.convertToType(data['errors'], [Error]);
      }
    }
    return obj;
  }


  /**
   * @member {Array.<module:model/Error>} errors
   */
  exports.prototype['errors'] = undefined;




  return exports;
}));
