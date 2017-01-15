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
    root.UserAdministrationApi.PaginationLinks = factory(root.UserAdministrationApi.ApiClient);
  }
}(this, function(ApiClient) {
  'use strict';

  /**
   * The PaginationLinks model module.
   * @module model/PaginationLinks
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>PaginationLinks</code>.
   * @alias module:model/PaginationLinks
   * @class
   */
  var exports = function() {



  };

  /**
   * Constructs a <code>PaginationLinks</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/PaginationLinks} obj Optional instance to populate.
   * @return {module:model/PaginationLinks} The populated <code>PaginationLinks</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('next')) {
        obj['next'] = ApiClient.convertToType(data['next'], 'String');
      }
      if (data.hasOwnProperty('previous')) {
        obj['previous'] = ApiClient.convertToType(data['previous'], 'String');
      }
    }
    return obj;
  }


  /**
   * @member {String} next
   */
  exports.prototype['next'] = undefined;

  /**
   * @member {String} previous
   */
  exports.prototype['previous'] = undefined;




  return exports;
}));
