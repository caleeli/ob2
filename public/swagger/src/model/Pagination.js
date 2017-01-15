(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', './PaginationLinks'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('./PaginationLinks'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.Pagination = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.PaginationLinks);
  }
}(this, function(ApiClient, PaginationLinks) {
  'use strict';

  /**
   * The Pagination model module.
   * @module model/Pagination
   * @version 1.0.0
   */

  /**
   * Constructs a new <code>Pagination</code>.
   * @alias module:model/Pagination
   * @class
   * @param total
   * @param count
   * @param perPage
   * @param currentPage
   * @param totalPages
   */
  var exports = function(total, count, perPage, currentPage, totalPages) {

    this['total'] = total;
    this['count'] = count;
    this['per_page'] = perPage;
    this['current_page'] = currentPage;
    this['total_pages'] = totalPages;

  };

  /**
   * Constructs a <code>Pagination</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/Pagination} obj Optional instance to populate.
   * @return {module:model/Pagination} The populated <code>Pagination</code> instance.
   */
  exports.constructFromObject = function(data, obj) {
    if (data) { 
      obj = obj || new exports();

      if (data.hasOwnProperty('total')) {
        obj['total'] = ApiClient.convertToType(data['total'], 'Integer');
      }
      if (data.hasOwnProperty('count')) {
        obj['count'] = ApiClient.convertToType(data['count'], 'Integer');
      }
      if (data.hasOwnProperty('per_page')) {
        obj['per_page'] = ApiClient.convertToType(data['per_page'], 'Integer');
      }
      if (data.hasOwnProperty('current_page')) {
        obj['current_page'] = ApiClient.convertToType(data['current_page'], 'Integer');
      }
      if (data.hasOwnProperty('total_pages')) {
        obj['total_pages'] = ApiClient.convertToType(data['total_pages'], 'Integer');
      }
      if (data.hasOwnProperty('links')) {
        obj['links'] = PaginationLinks.constructFromObject(data['links']);
      }
    }
    return obj;
  }


  /**
   * @member {Integer} total
   */
  exports.prototype['total'] = undefined;

  /**
   * @member {Integer} count
   */
  exports.prototype['count'] = undefined;

  /**
   * @member {Integer} per_page
   */
  exports.prototype['per_page'] = undefined;

  /**
   * @member {Integer} current_page
   */
  exports.prototype['current_page'] = undefined;

  /**
   * @member {Integer} total_pages
   */
  exports.prototype['total_pages'] = undefined;

  /**
   * @member {module:model/PaginationLinks} links
   */
  exports.prototype['links'] = undefined;




  return exports;
}));
