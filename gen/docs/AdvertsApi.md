# AdvertsApi

All URIs are relative to *http://localhost*

Method | HTTP request | Description
------------- | ------------- | -------------
[**call33ae79d3d9e246defbb1b5069b53f1f0**](AdvertsApi.md#call33ae79d3d9e246defbb1b5069b53f1f0) | **POST** /adverts/{advertId}/favorite | 
[**call377309953d83da9bbb7e5ed16451f2c4**](AdvertsApi.md#call377309953d83da9bbb7e5ed16451f2c4) | **GET** /adverts/{advertId} | 
[**call533a1fbebde31664b7328a4ed8d841e1**](AdvertsApi.md#call533a1fbebde31664b7328a4ed8d841e1) | **GET** /adverts | 
[**call7de8de179d2b71c0211055ff6d605ee2**](AdvertsApi.md#call7de8de179d2b71c0211055ff6d605ee2) | **DELETE** /adverts/{advertId}/favorite | 


<a name="call33ae79d3d9e246defbb1b5069b53f1f0"></a>
# **call33ae79d3d9e246defbb1b5069b53f1f0**
> call33ae79d3d9e246defbb1b5069b53f1f0(advertId)



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.AdvertsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    AdvertsApi apiInstance = new AdvertsApi(defaultClient);
    Integer advertId = 56; // Integer | 
    try {
      apiInstance.call33ae79d3d9e246defbb1b5069b53f1f0(advertId);
    } catch (ApiException e) {
      System.err.println("Exception when calling AdvertsApi#call33ae79d3d9e246defbb1b5069b53f1f0");
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
 **advertId** | **Integer**|  |

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
**201** | Success response |  -  |

<a name="call377309953d83da9bbb7e5ed16451f2c4"></a>
# **call377309953d83da9bbb7e5ed16451f2c4**
> call377309953d83da9bbb7e5ed16451f2c4(advertId)



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.AdvertsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    AdvertsApi apiInstance = new AdvertsApi(defaultClient);
    Integer advertId = 56; // Integer | ID of advert
    try {
      apiInstance.call377309953d83da9bbb7e5ed16451f2c4(advertId);
    } catch (ApiException e) {
      System.err.println("Exception when calling AdvertsApi#call377309953d83da9bbb7e5ed16451f2c4");
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
 **advertId** | **Integer**| ID of advert |

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

<a name="call533a1fbebde31664b7328a4ed8d841e1"></a>
# **call533a1fbebde31664b7328a4ed8d841e1**
> call533a1fbebde31664b7328a4ed8d841e1()



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.AdvertsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    AdvertsApi apiInstance = new AdvertsApi(defaultClient);
    try {
      apiInstance.call533a1fbebde31664b7328a4ed8d841e1();
    } catch (ApiException e) {
      System.err.println("Exception when calling AdvertsApi#call533a1fbebde31664b7328a4ed8d841e1");
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

<a name="call7de8de179d2b71c0211055ff6d605ee2"></a>
# **call7de8de179d2b71c0211055ff6d605ee2**
> call7de8de179d2b71c0211055ff6d605ee2(advertId)



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.AdvertsApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    AdvertsApi apiInstance = new AdvertsApi(defaultClient);
    Integer advertId = 56; // Integer | 
    try {
      apiInstance.call7de8de179d2b71c0211055ff6d605ee2(advertId);
    } catch (ApiException e) {
      System.err.println("Exception when calling AdvertsApi#call7de8de179d2b71c0211055ff6d605ee2");
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
 **advertId** | **Integer**|  |

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
**204** | Success response |  -  |

