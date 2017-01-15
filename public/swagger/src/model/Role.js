(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './UserAttributes'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./UserAttributes'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.Role = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.UserAttributes);
  }
}(this, function(ApiClient, UserAttributes) {
  'use strict';

  /**
   * The Role model module.
   * @module model/Role
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>Role</code>.
   * @alias module:model/Role
   * @class
   * @param type
   */
  var exports = function(type) {


    this['type'] = type;

  };

  /**
   * Constructs a <code>Role</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/Role} obj Optional instance to populate.
   * @return {module:model/Role} The populated <code>Role</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('id')) {
        obj['id'] = ApiClient.convertToType(data['id'], 'String');
      }
      if (data.hasOwnProperty('type')) {
        obj['type'] = ApiClient.convertToType(data['type'], 'String');
      }
      if (data.hasOwnProperty('attributes')) {
        obj['attributes'] = UserAttributes.constructFromObject(data['attributes']);
      }
    }
    return obj;
  }


  /**
   * @member {String} id
   */
  exports.prototype['id'] = undefined;

  /**
   * @member {String} type
   * @default 'group'
   */
  exports.prototype['type'] = 'group';

  /**
   * @member {module:model/UserAttributes} attributes
   */
  exports.prototype['attributes'] = undefined;




  return exports;
}));
