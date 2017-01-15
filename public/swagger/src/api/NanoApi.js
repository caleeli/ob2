(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['../ApiClient', '../model/ErrorArray', '../model/InlineResponse2001', '../model/LoginCreateItem', '../model/PhoneCreateItem', '../model/InlineResponse2003', '../model/RoleCreateItem', '../model/InlineResponse2005', '../model/UserCreateItem', '../model/InlineResponse2007', '../model/ResultSuccess', '../model/InlineResponse200', '../model/InlineResponse2002', '../model/InlineResponse2004', '../model/InlineResponse2006', '../model/LoginUpdateItem', '../model/PhoneUpdateItem', '../model/RoleUpdateItem', '../model/UserUpdateItem'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('../ApiClient'), require('../model/ErrorArray'), require('../model/InlineResponse2001'), require('../model/LoginCreateItem'), require('../model/PhoneCreateItem'), require('../model/InlineResponse2003'), require('../model/RoleCreateItem'), require('../model/InlineResponse2005'), require('../model/UserCreateItem'), require('../model/InlineResponse2007'), require('../model/ResultSuccess'), require('../model/InlineResponse200'), require('../model/InlineResponse2002'), require('../model/InlineResponse2004'), require('../model/InlineResponse2006'), require('../model/LoginUpdateItem'), require('../model/PhoneUpdateItem'), require('../model/RoleUpdateItem'), require('../model/UserUpdateItem'));
  } else {
    // Browser globals (root is window)
    if (!root.UserAdministrationApi) {
      root.UserAdministrationApi = {};
    }
    root.UserAdministrationApi.NanoApi = factory(root.UserAdministrationApi.ApiClient, root.UserAdministrationApi.ErrorArray, root.UserAdministrationApi.InlineResponse2001, root.UserAdministrationApi.LoginCreateItem, root.UserAdministrationApi.PhoneCreateItem, root.UserAdministrationApi.InlineResponse2003, root.UserAdministrationApi.RoleCreateItem, root.UserAdministrationApi.InlineResponse2005, root.UserAdministrationApi.UserCreateItem, root.UserAdministrationApi.InlineResponse2007, root.UserAdministrationApi.ResultSuccess, root.UserAdministrationApi.InlineResponse200, root.UserAdministrationApi.InlineResponse2002, root.UserAdministrationApi.InlineResponse2004, root.UserAdministrationApi.InlineResponse2006, root.UserAdministrationApi.LoginUpdateItem, root.UserAdministrationApi.PhoneUpdateItem, root.UserAdministrationApi.RoleUpdateItem, root.UserAdministrationApi.UserUpdateItem);
  }
}(this, function(ApiClient, ErrorArray, InlineResponse2001, LoginCreateItem, PhoneCreateItem, InlineResponse2003, RoleCreateItem, InlineResponse2005, UserCreateItem, InlineResponse2007, ResultSuccess, InlineResponse200, InlineResponse2002, InlineResponse2004, InlineResponse2006, LoginUpdateItem, PhoneUpdateItem, RoleUpdateItem, UserUpdateItem) {
  'use strict';

  /**
   * Nano service.
   * @module api/NanoApi
   * @version 1.0.0
   */

  /**
   * Constructs a new NanoApi. 
   * @alias module:api/NanoApi
   * @class
   * @param {module:ApiClient} apiClient Optional API client implementation to use, default to {@link module:ApiClient#instance}
   * if unspecified.
   */
  var exports = function(apiClient) {
    this.apiClient = apiClient || ApiClient.instance;


    /**
     * Callback function to receive the result of the addLogin operation.
     * @callback module:api/NanoApi~addLoginCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2001} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Creates a new login
     * @param {module:model/LoginCreateItem} loginCreateItem JsonApi with the login object to add
     * @param {module:api/NanoApi~addLoginCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2001}
     */
    this.addLogin = function(loginCreateItem, callback) {
      var postBody = loginCreateItem;

      // verify the required parameter 'loginCreateItem' is set
      if (loginCreateItem == undefined || loginCreateItem == null) {
        throw "Missing the required parameter 'loginCreateItem' when calling addLogin";
      }


      var pathParams = {
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2001;

      return this.apiClient.callApi(
        '/logins', 'POST',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the addPhone operation.
     * @callback module:api/NanoApi~addPhoneCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2003} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Creates a new phone
     * @param {module:model/PhoneCreateItem} phoneCreateItem JsonApi with the phone object to add
     * @param {module:api/NanoApi~addPhoneCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2003}
     */
    this.addPhone = function(phoneCreateItem, callback) {
      var postBody = phoneCreateItem;

      // verify the required parameter 'phoneCreateItem' is set
      if (phoneCreateItem == undefined || phoneCreateItem == null) {
        throw "Missing the required parameter 'phoneCreateItem' when calling addPhone";
      }


      var pathParams = {
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2003;

      return this.apiClient.callApi(
        '/phones', 'POST',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the addRole operation.
     * @callback module:api/NanoApi~addRoleCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2005} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Creates a new role
     * @param {module:model/RoleCreateItem} roleCreateItem JsonApi with the role object to add
     * @param {module:api/NanoApi~addRoleCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2005}
     */
    this.addRole = function(roleCreateItem, callback) {
      var postBody = roleCreateItem;

      // verify the required parameter 'roleCreateItem' is set
      if (roleCreateItem == undefined || roleCreateItem == null) {
        throw "Missing the required parameter 'roleCreateItem' when calling addRole";
      }


      var pathParams = {
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2005;

      return this.apiClient.callApi(
        '/roles', 'POST',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the addUser operation.
     * @callback module:api/NanoApi~addUserCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2007} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Creates a new user
     * @param {module:model/UserCreateItem} userCreateItem JsonApi with the user object to add
     * @param {module:api/NanoApi~addUserCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2007}
     */
    this.addUser = function(userCreateItem, callback) {
      var postBody = userCreateItem;

      // verify the required parameter 'userCreateItem' is set
      if (userCreateItem == undefined || userCreateItem == null) {
        throw "Missing the required parameter 'userCreateItem' when calling addUser";
      }


      var pathParams = {
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2007;

      return this.apiClient.callApi(
        '/users', 'POST',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the deleteLogin operation.
     * @callback module:api/NanoApi~deleteLoginCallback
     * @param {String} error Error message, if any.
     * @param {Object} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Deletes a single item based on the ID supplied
     * @param {String} id ID of item to delete
     * @param {module:api/NanoApi~deleteLoginCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {Object}
     */
    this.deleteLogin = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling deleteLogin";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = Object;

      return this.apiClient.callApi(
        '/logins/{id}', 'DELETE',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the deletePhone operation.
     * @callback module:api/NanoApi~deletePhoneCallback
     * @param {String} error Error message, if any.
     * @param {Object} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Deletes a single item based on the ID supplied
     * @param {String} id ID of item to delete
     * @param {module:api/NanoApi~deletePhoneCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {Object}
     */
    this.deletePhone = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling deletePhone";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = Object;

      return this.apiClient.callApi(
        '/phones/{id}', 'DELETE',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the deleteRole operation.
     * @callback module:api/NanoApi~deleteRoleCallback
     * @param {String} error Error message, if any.
     * @param {Object} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Deletes a single item based on the ID supplied
     * @param {String} id ID of item to delete
     * @param {module:api/NanoApi~deleteRoleCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {Object}
     */
    this.deleteRole = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling deleteRole";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = Object;

      return this.apiClient.callApi(
        '/roles/{id}', 'DELETE',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the deleteUser operation.
     * @callback module:api/NanoApi~deleteUserCallback
     * @param {String} error Error message, if any.
     * @param {Object} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Deletes a single item based on the ID supplied
     * @param {String} id ID of item to delete
     * @param {module:api/NanoApi~deleteUserCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {Object}
     */
    this.deleteUser = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling deleteUser";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = Object;

      return this.apiClient.callApi(
        '/users/{id}', 'DELETE',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findLoginById operation.
     * @callback module:api/NanoApi~findLoginByIdCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2001} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns the login based on a single ID
     * @param {String} id ID of Login to fetch
     * @param {module:api/NanoApi~findLoginByIdCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2001}
     */
    this.findLoginById = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling findLoginById";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2001;

      return this.apiClient.callApi(
        '/logins/{id}', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findLogins operation.
     * @callback module:api/NanoApi~findLoginsCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse200} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns all Logins
     * @param {Object} opts Optional parameters
     * @param {Integer} opts.page Page Nr to fetch (default to 1)
     * @param {Integer} opts.perPage Amount of Items per Page (default to 15)
     * @param {module:api/NanoApi~findLoginsCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse200}
     */
    this.findLogins = function(opts, callback) {
      opts = opts || {};
      var postBody = null;


      var pathParams = {
      };
      var queryParams = {
        'page': opts['page'],
        'per_page': opts['perPage']
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse200;

      return this.apiClient.callApi(
        '/logins', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findPhoneById operation.
     * @callback module:api/NanoApi~findPhoneByIdCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2003} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns the phone based on a single ID
     * @param {String} id ID of Phone to fetch
     * @param {module:api/NanoApi~findPhoneByIdCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2003}
     */
    this.findPhoneById = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling findPhoneById";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2003;

      return this.apiClient.callApi(
        '/phones/{id}', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findPhones operation.
     * @callback module:api/NanoApi~findPhonesCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2002} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns all Phones
     * @param {Object} opts Optional parameters
     * @param {Integer} opts.page Page Nr to fetch (default to 1)
     * @param {Integer} opts.perPage Amount of Items per Page (default to 15)
     * @param {module:api/NanoApi~findPhonesCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2002}
     */
    this.findPhones = function(opts, callback) {
      opts = opts || {};
      var postBody = null;


      var pathParams = {
      };
      var queryParams = {
        'page': opts['page'],
        'per_page': opts['perPage']
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2002;

      return this.apiClient.callApi(
        '/phones', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findRoleById operation.
     * @callback module:api/NanoApi~findRoleByIdCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2005} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns the role based on a single ID
     * @param {String} id ID of Role to fetch
     * @param {module:api/NanoApi~findRoleByIdCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2005}
     */
    this.findRoleById = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling findRoleById";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2005;

      return this.apiClient.callApi(
        '/roles/{id}', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findRoles operation.
     * @callback module:api/NanoApi~findRolesCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2004} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns all Roles
     * @param {Object} opts Optional parameters
     * @param {Integer} opts.page Page Nr to fetch (default to 1)
     * @param {Integer} opts.perPage Amount of Items per Page (default to 15)
     * @param {module:api/NanoApi~findRolesCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2004}
     */
    this.findRoles = function(opts, callback) {
      opts = opts || {};
      var postBody = null;


      var pathParams = {
      };
      var queryParams = {
        'page': opts['page'],
        'per_page': opts['perPage']
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2004;

      return this.apiClient.callApi(
        '/roles', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findUserById operation.
     * @callback module:api/NanoApi~findUserByIdCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2007} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns the user based on a single ID
     * @param {String} id ID of User to fetch
     * @param {module:api/NanoApi~findUserByIdCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2007}
     */
    this.findUserById = function(id, callback) {
      var postBody = null;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling findUserById";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2007;

      return this.apiClient.callApi(
        '/users/{id}', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the findUsers operation.
     * @callback module:api/NanoApi~findUsersCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2006} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Returns all Users
     * @param {Object} opts Optional parameters
     * @param {Integer} opts.page Page Nr to fetch (default to 1)
     * @param {Integer} opts.perPage Amount of Items per Page (default to 15)
     * @param {module:api/NanoApi~findUsersCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2006}
     */
    this.findUsers = function(opts, callback) {
      opts = opts || {};
      var postBody = null;


      var pathParams = {
      };
      var queryParams = {
        'page': opts['page'],
        'per_page': opts['perPage']
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2006;

      return this.apiClient.callApi(
        '/users', 'GET',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the updateLogin operation.
     * @callback module:api/NanoApi~updateLoginCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2001} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Update existing login
     * @param {String} id ID of login to fetch
     * @param {module:model/LoginUpdateItem} loginUpdateItem Login object to edit
     * @param {module:api/NanoApi~updateLoginCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2001}
     */
    this.updateLogin = function(id, loginUpdateItem, callback) {
      var postBody = loginUpdateItem;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling updateLogin";
      }

      // verify the required parameter 'loginUpdateItem' is set
      if (loginUpdateItem == undefined || loginUpdateItem == null) {
        throw "Missing the required parameter 'loginUpdateItem' when calling updateLogin";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2001;

      return this.apiClient.callApi(
        '/logins/{id}', 'PUT',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the updatePhone operation.
     * @callback module:api/NanoApi~updatePhoneCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2003} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Update existing phone
     * @param {String} id ID of phone to fetch
     * @param {module:model/PhoneUpdateItem} phoneUpdateItem Phone object to edit
     * @param {module:api/NanoApi~updatePhoneCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2003}
     */
    this.updatePhone = function(id, phoneUpdateItem, callback) {
      var postBody = phoneUpdateItem;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling updatePhone";
      }

      // verify the required parameter 'phoneUpdateItem' is set
      if (phoneUpdateItem == undefined || phoneUpdateItem == null) {
        throw "Missing the required parameter 'phoneUpdateItem' when calling updatePhone";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2003;

      return this.apiClient.callApi(
        '/phones/{id}', 'PUT',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the updateRole operation.
     * @callback module:api/NanoApi~updateRoleCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2005} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Update existing role
     * @param {String} id ID of role to fetch
     * @param {module:model/RoleUpdateItem} roleUpdateItem Role object to edit
     * @param {module:api/NanoApi~updateRoleCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2005}
     */
    this.updateRole = function(id, roleUpdateItem, callback) {
      var postBody = roleUpdateItem;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling updateRole";
      }

      // verify the required parameter 'roleUpdateItem' is set
      if (roleUpdateItem == undefined || roleUpdateItem == null) {
        throw "Missing the required parameter 'roleUpdateItem' when calling updateRole";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2005;

      return this.apiClient.callApi(
        '/roles/{id}', 'PUT',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }

    /**
     * Callback function to receive the result of the updateUser operation.
     * @callback module:api/NanoApi~updateUserCallback
     * @param {String} error Error message, if any.
     * @param {module:model/InlineResponse2007} data The data returned by the service call.
     * @param {String} response The complete HTTP response.
     */

    /**
     * Update existing user
     * @param {String} id ID of user to fetch
     * @param {module:model/UserUpdateItem} userUpdateItem User object to edit
     * @param {module:api/NanoApi~updateUserCallback} callback The callback function, accepting three arguments: error, data, response
     * data is of type: {module:model/InlineResponse2007}
     */
    this.updateUser = function(id, userUpdateItem, callback) {
      var postBody = userUpdateItem;

      // verify the required parameter 'id' is set
      if (id == undefined || id == null) {
        throw "Missing the required parameter 'id' when calling updateUser";
      }

      // verify the required parameter 'userUpdateItem' is set
      if (userUpdateItem == undefined || userUpdateItem == null) {
        throw "Missing the required parameter 'userUpdateItem' when calling updateUser";
      }


      var pathParams = {
        'id': id
      };
      var queryParams = {
      };
      var headerParams = {
      };
      var formParams = {
      };

      var authNames = ['internalApiKey', 'PasswordGrant'];
      var contentTypes = ['application/vnd.api+json'];
      var accepts = ['application/vnd.api+json'];
      var returnType = InlineResponse2007;

      return this.apiClient.callApi(
        '/users/{id}', 'PUT',
        pathParams, queryParams, headerParams, formParams, postBody,
        authNames, contentTypes, accepts, returnType, callback
      );
    }
  };

  return exports;
}));
