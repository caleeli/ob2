(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './Meta', './User'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./Meta'), require('./User'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.InlineResponse2006 = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.Meta, root.UserAdministrationApi.User);
  }
}(this, function(ApiClient, Meta, User) {
  'use strict';

  /**
   * The InlineResponse2006 model module.
   * @module model/InlineResponse2006
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>InlineResponse2006</code>.
   * Json Api Response
   * @alias module:model/InlineResponse2006
   * @class
   */
  var exports = function() {



  };

  /**
   * Constructs a <code>InlineResponse2006</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/InlineResponse2006} obj Optional instance to populate.
   * @return {module:model/InlineResponse2006} The populated <code>InlineResponse2006</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('data')) {
        obj['data'] = ApiClient.convertToType(data['data'], [User]);
      }
      if (data.hasOwnProperty('meta')) {
        obj['meta'] = Meta.constructFromObject(data['meta']);
      }
    }
    return obj;
  }


  /**
   * @member {Array.<module:model/User>} data
   */
  exports.prototype['data'] = undefined;

  /**
   * @member {module:model/Meta} meta
   */
  exports.prototype['meta'] = undefined;




  return exports;
}));
