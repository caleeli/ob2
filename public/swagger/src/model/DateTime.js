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
    root.UserAdministrationApi.DateTime = factory(root.UserAdministrationApi.ApiClient);
  }
}(this, function(ApiClient) {
  'use strict';

  /**
   * The DateTime model module.
   * @module model/DateTime
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>DateTime</code>.
   * @alias module:model/DateTime
   * @class
   * @param _date
   * @param timezoneType
   * @param timezone
   */
  var exports = function(_date, timezoneType, timezone) {

    this['date'] = _date;
    this['timezone_type'] = timezoneType;
    this['timezone'] = timezone;
  };

  /**
   * Constructs a <code>DateTime</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/DateTime} obj Optional instance to populate.
   * @return {module:model/DateTime} The populated <code>DateTime</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('date')) {
        obj['date'] = ApiClient.convertToType(data['date'], 'String');
      }
      if (data.hasOwnProperty('timezone_type')) {
        obj['timezone_type'] = ApiClient.convertToType(data['timezone_type'], 'Integer');
      }
      if (data.hasOwnProperty('timezone')) {
        obj['timezone'] = ApiClient.convertToType(data['timezone'], 'String');
      }
    }
    return obj;
  }


  /**
   * @member {String} date
   */
  exports.prototype['date'] = undefined;

  /**
   * @member {Integer} timezone_type
   */
  exports.prototype['timezone_type'] = undefined;

  /**
   * @member {String} timezone
   */
  exports.prototype['timezone'] = undefined;




  return exports;
}));
