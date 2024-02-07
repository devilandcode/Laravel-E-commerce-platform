# ProfileApi

All URIs are relative to *http://localhost*

Method | HTTP request | Description
------------- | ------------- | -------------
[**call4d471f45098fecbafcd2f589b41448ec**](ProfileApi.md#call4d471f45098fecbafcd2f589b41448ec) | **PUT** /user | 
[**call6526a7845e1078d2ca4047f9dfeb7388**](ProfileApi.md#call6526a7845e1078d2ca4047f9dfeb7388) | **POST** /register | 
[**e8e42fa22aeacc6854b2347f08f9c761**](ProfileApi.md#e8e42fa22aeacc6854b2347f08f9c761) | **GET** /user | 


<a name="call4d471f45098fecbafcd2f589b41448ec"></a>
# **call4d471f45098fecbafcd2f589b41448ec**
> call4d471f45098fecbafcd2f589b41448ec(name, lastName, password)



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProfileApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    ProfileApi apiInstance = new ProfileApi(defaultClient);
    String name = "name_example"; // String | User's name
    String lastName = "lastName_example"; // String | User's last name
    String password = "password_example"; // String | User's phone
    try {
      apiInstance.call4d471f45098fecbafcd2f589b41448ec(name, lastName, password);
    } catch (ApiException e) {
      System.err.println("Exception when calling ProfileApi#call4d471f45098fecbafcd2f589b41448ec");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **String**| User&#39;s name |
 **lastName** | **String**| User&#39;s last name |
 **password** | **String**| User&#39;s phone |

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Success response |  -  |
**422** | Validation errors |  -  |

<a name="call6526a7845e1078d2ca4047f9dfeb7388"></a>
# **call6526a7845e1078d2ca4047f9dfeb7388**
> call6526a7845e1078d2ca4047f9dfeb7388(name, email, password)



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProfileApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    ProfileApi apiInstance = new ProfileApi(defaultClient);
    String name = "name_example"; // String | User's name
    String email = "email_example"; // String | User's email
    String password = "password_example"; // String | User's password
    try {
      apiInstance.call6526a7845e1078d2ca4047f9dfeb7388(name, email, password);
    } catch (ApiException e) {
      System.err.println("Exception when calling ProfileApi#call6526a7845e1078d2ca4047f9dfeb7388");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **String**| User&#39;s name |
 **email** | **String**| User&#39;s email |
 **password** | **String**| User&#39;s password |

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**201** | User registered successfully |  -  |
**422** | Validation errors |  -  |

<a name="e8e42fa22aeacc6854b2347f08f9c761"></a>
# **e8e42fa22aeacc6854b2347f08f9c761**
> e8e42fa22aeacc6854b2347f08f9c761()



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ProfileApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    ProfileApi apiInstance = new ProfileApi(defaultClient);
    try {
      apiInstance.e8e42fa22aeacc6854b2347f08f9c761();
    } catch (ApiException e) {
      System.err.println("Exception when calling ProfileApi#e8e42fa22aeacc6854b2347f08f9c761");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Success response |  -  |

