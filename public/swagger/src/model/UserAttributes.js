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
    root.UserAdministrationApi.UserAttributes = factory(root.UserAdministrationApi.ApiClient);
  }
}(this, function(ApiClient) {
  'use strict';

  /**
   * The UserAttributes model module.
   * @module model/UserAttributes
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>UserAttributes</code>.
   * @alias module:model/UserAttributes
   * @class
   * @param code
   * @param title
   */
  var exports = function(code, title) {

    this['code'] = code;



    this['title'] = title;

  };

  /**
   * Constructs a <code>UserAttributes</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/UserAttributes} obj Optional instance to populate.
   * @return {module:model/UserAttributes} The populated <code>UserAttributes</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('code')) {
        obj['code'] = ApiClient.convertToType(data['code'], 'String');
      }
      if (data.hasOwnProperty('updated_at')) {
        obj['updated_at'] = 'Date'.constructFromObject(data['updated_at']);
      }
      if (data.hasOwnProperty('description')) {
        obj['description'] = ApiClient.convertToType(data['description'], 'String');
      }
      if (data.hasOwnProperty('created_at')) {
        obj['created_at'] = 'Date'.constructFromObject(data['created_at']);
      }
      if (data.hasOwnProperty('title')) {
        obj['title'] = ApiClient.convertToType(data['title'], 'String');
      }
      if (data.hasOwnProperty('status')) {
        obj['status'] = ApiClient.convertToType(data['status'], 'String');
      }
    }
    return obj;
  }


  /**
   * @member {String} code
   */
  exports.prototype['code'] = undefined;

  /**
   * @member {Date} updated_at
   */
  exports.prototype['updated_at'] = undefined;

  /**
   * @member {String} description
   */
  exports.prototype['description'] = undefined;

  /**
   * @member {Date} created_at
   */
  exports.prototype['created_at'] = undefined;

  /**
   * @member {String} title
   */
  exports.prototype['title'] = undefined;

  /**
   * @member {module:model/UserAttributes.StatusEnum} status
   * @default 'ACTIVE'
   */
  exports.prototype['status'] = 'ACTIVE';


  /**
   * Allowed values for the <code>status</code> property.
   * @enum {String}
   * @readonly
   */
  exports.StatusEnum = { 
    /**
     * value: ACTIVE
     * @const
     */
    ACTIVE: "ACTIVE",
    
    /**
     * value: INACTIVE
     * @const
     */
    INACTIVE: "INACTIVE"
  };

  return exports;
}));
