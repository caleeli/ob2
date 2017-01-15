(function(factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['./ApiClient', './model/DateTime', './model/Error', './model/ErrorArray', './model/InlineResponse200', './model/InlineResponse2001', './model/InlineResponse2002', './model/InlineResponse2003', './model/InlineResponse2004', './model/InlineResponse2005', './model/InlineResponse2006', './model/InlineResponse2007', './model/Login', './model/LoginCreateItem', './model/LoginUpdateItem', './model/Meta', './model/Pagination', './model/PaginationLinks', './model/Phone', './model/PhoneCreateItem', './model/PhoneUpdateItem', './model/ResultSuccess', './model/ResultSuccessMeta', './model/Role', './model/RoleCreateItem', './model/RoleUpdateItem', './model/User', './model/UserAttributes', './model/UserCreateItem', './model/UserUpdateItem', './api/NanoApi'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    module.exports = factory(require('./ApiClient'), require('./model/DateTime'), require('./model/Error'), require('./model/ErrorArray'), require('./model/InlineResponse200'), require('./model/InlineResponse2001'), require('./model/InlineResponse2002'), require('./model/InlineResponse2003'), require('./model/InlineResponse2004'), require('./model/InlineResponse2005'), require('./model/InlineResponse2006'), require('./model/InlineResponse2007'), require('./model/Login'), require('./model/LoginCreateItem'), require('./model/LoginUpdateItem'), require('./model/Meta'), require('./model/Pagination'), require('./model/PaginationLinks'), require('./model/Phone'), require('./model/PhoneCreateItem'), require('./model/PhoneUpdateItem'), require('./model/ResultSuccess'), require('./model/ResultSuccessMeta'), require('./model/Role'), require('./model/RoleCreateItem'), require('./model/RoleUpdateItem'), require('./model/User'), require('./model/UserAttributes'), require('./model/UserCreateItem'), require('./model/UserUpdateItem'), require('./api/NanoApi'));
  }
}(function(ApiClient, DateTime, Error, ErrorArray, InlineResponse200, InlineResponse2001, InlineResponse2002, InlineResponse2003, InlineResponse2004, InlineResponse2005, InlineResponse2006, InlineResponse2007, Login, LoginCreateItem, LoginUpdateItem, Meta, Pagination, PaginationLinks, Phone, PhoneCreateItem, PhoneUpdateItem, ResultSuccess, ResultSuccessMeta, Role, RoleCreateItem, RoleUpdateItem, User, UserAttributes, UserCreateItem, UserUpdateItem, NanoApi) {
  'use strict';

  /**
   * An API to access UserAdministration.<br>
   * The <code>index</code> module provides access to constructors for all the classes which comprise the public API.
   * <p>
   * An AMD (recommended!) or CommonJS application will generally do something equivalent to the following:
   * <pre>
   * var UserAdministrationApi = require('./index'); // See note below*.
   * var xxxSvc = new UserAdministrationApi.XxxApi(); // Allocate the API class we're going to use.
   * var yyyModel = new UserAdministrationApi.Yyy(); // Construct a model instance.
   * yyyModel.someProperty = 'someValue';
   * ...
   * var zzz = xxxSvc.doSomething(yyyModel); // Invoke the service.
   * ...
   * </pre>
   * <em>*NOTE: For a top-level AMD script, use require(['./index'], function(){...}) and put the application logic within the
   * callback function.</em>
   * </p>
   * <p>
   * A non-AMD browser application (discouraged) might do something like this:
   * <pre>
   * var xxxSvc = new UserAdministrationApi.XxxApi(); // Allocate the API class we're going to use.
   * var yyy = new UserAdministrationApi.Yyy(); // Construct a model instance.
   * yyyModel.someProperty = 'someValue';
   * ...
   * var zzz = xxxSvc.doSomething(yyyModel); // Invoke the service.
   * ...
   * </pre>
   * </p>
   * @module index
   * @version 1.0.0
   */
  var exports = {
    /**
     * The ApiClient constructor.
     * @property {module:ApiClient}
     */
    ApiClient: ApiClient,
    /**
     * The DateTime model constructor.
     * @property {module:model/DateTime}
     */
    DateTime: DateTime,
    /**
     * The Error model constructor.
     * @property {module:model/Error}
     */
    Error: Error,
    /**
     * The ErrorArray model constructor.
     * @property {module:model/ErrorArray}
     */
    ErrorArray: ErrorArray,
    /**
     * The InlineResponse200 model constructor.
     * @property {module:model/InlineResponse200}
     */
    InlineResponse200: InlineResponse200,
    /**
     * The InlineResponse2001 model constructor.
     * @property {module:model/InlineResponse2001}
     */
    InlineResponse2001: InlineResponse2001,
    /**
     * The InlineResponse2002 model constructor.
     * @property {module:model/InlineResponse2002}
     */
    InlineResponse2002: InlineResponse2002,
    /**
     * The InlineResponse2003 model constructor.
     * @property {module:model/InlineResponse2003}
     */
    InlineResponse2003: InlineResponse2003,
    /**
     * The InlineResponse2004 model constructor.
     * @property {module:model/InlineResponse2004}
     */
    InlineResponse2004: InlineResponse2004,
    /**
     * The InlineResponse2005 model constructor.
     * @property {module:model/InlineResponse2005}
     */
    InlineResponse2005: InlineResponse2005,
    /**
     * The InlineResponse2006 model constructor.
     * @property {module:model/InlineResponse2006}
     */
    InlineResponse2006: InlineResponse2006,
    /**
     * The InlineResponse2007 model constructor.
     * @property {module:model/InlineResponse2007}
     */
    InlineResponse2007: InlineResponse2007,
    /**
     * The Login model constructor.
     * @property {module:model/Login}
     */
    Login: Login,
    /**
     * The LoginCreateItem model constructor.
     * @property {module:model/LoginCreateItem}
     */
    LoginCreateItem: LoginCreateItem,
    /**
     * The LoginUpdateItem model constructor.
     * @property {module:model/LoginUpdateItem}
     */
    LoginUpdateItem: LoginUpdateItem,
    /**
     * The Meta model constructor.
     * @property {module:model/Meta}
     */
    Meta: Meta,
    /**
     * The Pagination model constructor.
     * @property {module:model/Pagination}
     */
    Pagination: Pagination,
    /**
     * The PaginationLinks model constructor.
     * @property {module:model/PaginationLinks}
     */
    PaginationLinks: PaginationLinks,
    /**
     * The Phone model constructor.
     * @property {module:model/Phone}
     */
    Phone: Phone,
    /**
     * The PhoneCreateItem model constructor.
     * @property {module:model/PhoneCreateItem}
     */
    PhoneCreateItem: PhoneCreateItem,
    /**
     * The PhoneUpdateItem model constructor.
     * @property {module:model/PhoneUpdateItem}
     */
    PhoneUpdateItem: PhoneUpdateItem,
    /**
     * The ResultSuccess model constructor.
     * @property {module:model/ResultSuccess}
     */
    ResultSuccess: ResultSuccess,
    /**
     * The ResultSuccessMeta model constructor.
     * @property {module:model/ResultSuccessMeta}
     */
    ResultSuccessMeta: ResultSuccessMeta,
    /**
     * The Role model constructor.
     * @property {module:model/Role}
     */
    Role: Role,
    /**
     * The RoleCreateItem model constructor.
     * @property {module:model/RoleCreateItem}
     */
    RoleCreateItem: RoleCreateItem,
    /**
     * The RoleUpdateItem model constructor.
     * @property {module:model/RoleUpdateItem}
     */
    RoleUpdateItem: RoleUpdateItem,
    /**
     * The User model constructor.
     * @property {module:model/User}
     */
    User: User,
    /**
     * The UserAttributes model constructor.
     * @property {module:model/UserAttributes}
     */
    UserAttributes: UserAttributes,
    /**
     * The UserCreateItem model constructor.
     * @property {module:model/UserCreateItem}
     */
    UserCreateItem: UserCreateItem,
    /**
     * The UserUpdateItem model constructor.
     * @property {module:model/UserUpdateItem}
     */
    UserUpdateItem: UserUpdateItem,
    /**
     * The NanoApi service constructor.
     * @property {module:api/NanoApi}
     */
    NanoApi: NanoApi
  };

  return exports;
}));
