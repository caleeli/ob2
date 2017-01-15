# UserAdministrationApi.NanoApi

All URIs are relative to *http://localhost/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**addLogin**](NanoApi.md#addLogin) | **POST** /logins | 
[**addPhone**](NanoApi.md#addPhone) | **POST** /phones | 
[**addRole**](NanoApi.md#addRole) | **POST** /roles | 
[**addUser**](NanoApi.md#addUser) | **POST** /users | 
[**deleteLogin**](NanoApi.md#deleteLogin) | **DELETE** /logins/{id} | 
[**deletePhone**](NanoApi.md#deletePhone) | **DELETE** /phones/{id} | 
[**deleteRole**](NanoApi.md#deleteRole) | **DELETE** /roles/{id} | 
[**deleteUser**](NanoApi.md#deleteUser) | **DELETE** /users/{id} | 
[**findLoginById**](NanoApi.md#findLoginById) | **GET** /logins/{id} | 
[**findLogins**](NanoApi.md#findLogins) | **GET** /logins | 
[**findPhoneById**](NanoApi.md#findPhoneById) | **GET** /phones/{id} | 
[**findPhones**](NanoApi.md#findPhones) | **GET** /phones | 
[**findRoleById**](NanoApi.md#findRoleById) | **GET** /roles/{id} | 
[**findRoles**](NanoApi.md#findRoles) | **GET** /roles | 
[**findUserById**](NanoApi.md#findUserById) | **GET** /users/{id} | 
[**findUsers**](NanoApi.md#findUsers) | **GET** /users | 
[**updateLogin**](NanoApi.md#updateLogin) | **PUT** /logins/{id} | 
[**updatePhone**](NanoApi.md#updatePhone) | **PUT** /phones/{id} | 
[**updateRole**](NanoApi.md#updateRole) | **PUT** /roles/{id} | 
[**updateUser**](NanoApi.md#updateUser) | **PUT** /users/{id} | 


<a name="addLogin"></a>
# **addLogin**
> InlineResponse2001 addLogin(loginCreateItem)



Creates a new login

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var loginCreateItem = new UserAdministrationApi.LoginCreateItem(); // {LoginCreateItem} JsonApi with the login object to add


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.addLogin(loginCreateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **loginCreateItem** | [**LoginCreateItem**](LoginCreateItem.md)| JsonApi with the login object to add | 

### Return type

[**InlineResponse2001**](InlineResponse2001.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="addPhone"></a>
# **addPhone**
> InlineResponse2003 addPhone(phoneCreateItem)



Creates a new phone

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var phoneCreateItem = new UserAdministrationApi.PhoneCreateItem(); // {PhoneCreateItem} JsonApi with the phone object to add


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.addPhone(phoneCreateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **phoneCreateItem** | [**PhoneCreateItem**](PhoneCreateItem.md)| JsonApi with the phone object to add | 

### Return type

[**InlineResponse2003**](InlineResponse2003.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="addRole"></a>
# **addRole**
> InlineResponse2005 addRole(roleCreateItem)



Creates a new role

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var roleCreateItem = new UserAdministrationApi.RoleCreateItem(); // {RoleCreateItem} JsonApi with the role object to add


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.addRole(roleCreateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **roleCreateItem** | [**RoleCreateItem**](RoleCreateItem.md)| JsonApi with the role object to add | 

### Return type

[**InlineResponse2005**](InlineResponse2005.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="addUser"></a>
# **addUser**
> InlineResponse2007 addUser(userCreateItem)



Creates a new user

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var userCreateItem = new UserAdministrationApi.UserCreateItem(); // {UserCreateItem} JsonApi with the user object to add


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.addUser(userCreateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userCreateItem** | [**UserCreateItem**](UserCreateItem.md)| JsonApi with the user object to add | 

### Return type

[**InlineResponse2007**](InlineResponse2007.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="deleteLogin"></a>
# **deleteLogin**
> Object deleteLogin(id)



Deletes a single item based on the ID supplied

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of item to delete


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.deleteLogin(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of item to delete | 

### Return type

**Object**

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="deletePhone"></a>
# **deletePhone**
> Object deletePhone(id)



Deletes a single item based on the ID supplied

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of item to delete


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.deletePhone(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of item to delete | 

### Return type

**Object**

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="deleteRole"></a>
# **deleteRole**
> Object deleteRole(id)



Deletes a single item based on the ID supplied

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of item to delete


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.deleteRole(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of item to delete | 

### Return type

**Object**

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="deleteUser"></a>
# **deleteUser**
> Object deleteUser(id)



Deletes a single item based on the ID supplied

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of item to delete


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.deleteUser(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of item to delete | 

### Return type

**Object**

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findLoginById"></a>
# **findLoginById**
> InlineResponse2001 findLoginById(id)



Returns the login based on a single ID

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of Login to fetch


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findLoginById(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of Login to fetch | 

### Return type

[**InlineResponse2001**](InlineResponse2001.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findLogins"></a>
# **findLogins**
> InlineResponse200 findLogins(opts)



Returns all Logins

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var opts = { 
  'page': 1, // {Integer} Page Nr to fetch
  'perPage': 15 // {Integer} Amount of Items per Page
};

var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findLogins(opts, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | [**Integer**](.md)| Page Nr to fetch | [optional] [default to 1]
 **perPage** | [**Integer**](.md)| Amount of Items per Page | [optional] [default to 15]

### Return type

[**InlineResponse200**](InlineResponse200.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findPhoneById"></a>
# **findPhoneById**
> InlineResponse2003 findPhoneById(id)



Returns the phone based on a single ID

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of Phone to fetch


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findPhoneById(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of Phone to fetch | 

### Return type

[**InlineResponse2003**](InlineResponse2003.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findPhones"></a>
# **findPhones**
> InlineResponse2002 findPhones(opts)



Returns all Phones

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var opts = { 
  'page': 1, // {Integer} Page Nr to fetch
  'perPage': 15 // {Integer} Amount of Items per Page
};

var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findPhones(opts, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | [**Integer**](.md)| Page Nr to fetch | [optional] [default to 1]
 **perPage** | [**Integer**](.md)| Amount of Items per Page | [optional] [default to 15]

### Return type

[**InlineResponse2002**](InlineResponse2002.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findRoleById"></a>
# **findRoleById**
> InlineResponse2005 findRoleById(id)



Returns the role based on a single ID

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of Role to fetch


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findRoleById(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of Role to fetch | 

### Return type

[**InlineResponse2005**](InlineResponse2005.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findRoles"></a>
# **findRoles**
> InlineResponse2004 findRoles(opts)



Returns all Roles

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var opts = { 
  'page': 1, // {Integer} Page Nr to fetch
  'perPage': 15 // {Integer} Amount of Items per Page
};

var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findRoles(opts, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | [**Integer**](.md)| Page Nr to fetch | [optional] [default to 1]
 **perPage** | [**Integer**](.md)| Amount of Items per Page | [optional] [default to 15]

### Return type

[**InlineResponse2004**](InlineResponse2004.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findUserById"></a>
# **findUserById**
> InlineResponse2007 findUserById(id)



Returns the user based on a single ID

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of User to fetch


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findUserById(id, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of User to fetch | 

### Return type

[**InlineResponse2007**](InlineResponse2007.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="findUsers"></a>
# **findUsers**
> InlineResponse2006 findUsers(opts)



Returns all Users

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var opts = { 
  'page': 1, // {Integer} Page Nr to fetch
  'perPage': 15 // {Integer} Amount of Items per Page
};

var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.findUsers(opts, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | [**Integer**](.md)| Page Nr to fetch | [optional] [default to 1]
 **perPage** | [**Integer**](.md)| Amount of Items per Page | [optional] [default to 15]

### Return type

[**InlineResponse2006**](InlineResponse2006.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="updateLogin"></a>
# **updateLogin**
> InlineResponse2001 updateLogin(id, loginUpdateItem)



Update existing login

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of login to fetch

var loginUpdateItem = new UserAdministrationApi.LoginUpdateItem(); // {LoginUpdateItem} Login object to edit


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.updateLogin(id, loginUpdateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of login to fetch | 
 **loginUpdateItem** | [**LoginUpdateItem**](LoginUpdateItem.md)| Login object to edit | 

### Return type

[**InlineResponse2001**](InlineResponse2001.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="updatePhone"></a>
# **updatePhone**
> InlineResponse2003 updatePhone(id, phoneUpdateItem)



Update existing phone

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of phone to fetch

var phoneUpdateItem = new UserAdministrationApi.PhoneUpdateItem(); // {PhoneUpdateItem} Phone object to edit


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.updatePhone(id, phoneUpdateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of phone to fetch | 
 **phoneUpdateItem** | [**PhoneUpdateItem**](PhoneUpdateItem.md)| Phone object to edit | 

### Return type

[**InlineResponse2003**](InlineResponse2003.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="updateRole"></a>
# **updateRole**
> InlineResponse2005 updateRole(id, roleUpdateItem)



Update existing role

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of role to fetch

var roleUpdateItem = new UserAdministrationApi.RoleUpdateItem(); // {RoleUpdateItem} Role object to edit


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.updateRole(id, roleUpdateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of role to fetch | 
 **roleUpdateItem** | [**RoleUpdateItem**](RoleUpdateItem.md)| Role object to edit | 

### Return type

[**InlineResponse2005**](InlineResponse2005.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

<a name="updateUser"></a>
# **updateUser**
> InlineResponse2007 updateUser(id, userUpdateItem)



Update existing user

### Example
```javascript
var UserAdministrationApi = require('user-administration-api');
var defaultClient = UserAdministrationApi.ApiClient.default;

// Configure API key authorization: internalApiKey
var internalApiKey = defaultClient.authentications['internalApiKey'];
internalApiKey.apiKey = "YOUR API KEY"
// Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
//internalApiKey.apiKeyPrefix['access_token'] = "Token"

// Configure OAuth2 access token for authorization: PasswordGrant
var PasswordGrant = defaultClient.authentications['PasswordGrant'];
PasswordGrant.accessToken = "YOUR ACCESS TOKEN"

var apiInstance = new UserAdministrationApi.NanoApi()

var id = "id_example"; // {String} ID of user to fetch

var userUpdateItem = new UserAdministrationApi.UserUpdateItem(); // {UserUpdateItem} User object to edit


var callback = function(error, data, response) {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully. Returned data: ' + data);
  }
};
api.updateUser(id, userUpdateItem, callback);
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **String**| ID of user to fetch | 
 **userUpdateItem** | [**UserUpdateItem**](UserUpdateItem.md)| User object to edit | 

### Return type

[**InlineResponse2007**](InlineResponse2007.md)

### Authorization

[internalApiKey](../README.md#internalApiKey), [PasswordGrant](../README.md#PasswordGrant)

### HTTP reuqest headers

 - **Content-Type**: application/vnd.api+json
 - **Accept**: application/vnd.api+json

