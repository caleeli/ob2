(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './User'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./User'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.InlineResponse2007 = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.User);
  }
}(this, function(ApiClient, User) {
  'use strict';

  /**
   * The InlineResponse2007 model module.
   * @module model/InlineResponse2007
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>InlineResponse2007</code>.
   * Json Api Response
   * @alias module:model/InlineResponse2007
   * @class
   * @param data
   */
  var exports = function(data) {

    this['data'] = data;
  };

  /**
   * Constructs a <code>InlineResponse2007</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/InlineResponse2007} obj Optional instance to populate.
   * @return {module:model/InlineResponse2007} The populated <code>InlineResponse2007</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('data')) {
        obj['data'] = User.constructFromObject(data['data']);
      }
    }
    return obj;
  }


  /**
   * @member {module:model/User} data
   */
  exports.prototype['data'] = undefined;




  return exports;
}));
