(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './ResultSuccessMeta'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./ResultSuccessMeta'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.ResultSuccess = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.ResultSuccessMeta);
  }
}(this, function(ApiClient, ResultSuccessMeta) {
  'use strict';

  /**
   * The ResultSuccess model module.
   * @module model/ResultSuccess
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>ResultSuccess</code>.
   * @alias module:model/ResultSuccess
   * @class
   */
  var exports = function() {


  };

  /**
   * Constructs a <code>ResultSuccess</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/ResultSuccess} obj Optional instance to populate.
   * @return {module:model/ResultSuccess} The populated <code>ResultSuccess</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('meta')) {
        obj['meta'] = ResultSuccessMeta.constructFromObject(data['meta']);
      }
    }
    return obj;
  }


  /**
   * @member {module:model/ResultSuccessMeta} meta
   */
  exports.prototype['meta'] = undefined;




  return exports;
}));
