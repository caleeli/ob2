(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './Role'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./Role'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.InlineResponse2005 = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.Role);
  }
}(this, function(ApiClient, Role) {
  'use strict';

  /**
   * The InlineResponse2005 model module.
   * @module model/InlineResponse2005
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>InlineResponse2005</code>.
   * Json Api Response
   * @alias module:model/InlineResponse2005
   * @class
   * @param data
   */
  var exports = function(data) {

    this['data'] = data;
  };

  /**
   * Constructs a <code>InlineResponse2005</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/InlineResponse2005} obj Optional instance to populate.
   * @return {module:model/InlineResponse2005} The populated <code>InlineResponse2005</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('data')) {
        obj['data'] = Role.constructFromObject(data['data']);
      }
    }
    return obj;
  }


  /**
   * @member {module:model/Role} data
   */
  exports.prototype['data'] = undefined;




  return exports;
}));
