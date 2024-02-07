# FavoritesApi

All URIs are relative to *http://localhost*

Method | HTTP request | Description
------------- | ------------- | -------------
[**a041101c22dbd91b01c75044517175aa**](FavoritesApi.md#a041101c22dbd91b01c75044517175aa) | **GET** /user/favorites | 
[**call51b5afa6272e746d07f1e0edb5168c85**](FavoritesApi.md#call51b5afa6272e746d07f1e0edb5168c85) | **DELETE** /user/favorites/{advertId} | 


<a name="a041101c22dbd91b01c75044517175aa"></a>
# **a041101c22dbd91b01c75044517175aa**
> a041101c22dbd91b01c75044517175aa()



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.FavoritesApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    FavoritesApi apiInstance = new FavoritesApi(defaultClient);
    try {
      apiInstance.a041101c22dbd91b01c75044517175aa();
    } catch (ApiException e) {
      System.err.println("Exception when calling FavoritesApi#a041101c22dbd91b01c75044517175aa");
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

<a name="call51b5afa6272e746d07f1e0edb5168c85"></a>
# **call51b5afa6272e746d07f1e0edb5168c85**
> call51b5afa6272e746d07f1e0edb5168c85(advertId)



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.FavoritesApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    FavoritesApi apiInstance = new FavoritesApi(defaultClient);
    Integer advertId = 56; // Integer | 
    try {
      apiInstance.call51b5afa6272e746d07f1e0edb5168c85(advertId);
    } catch (ApiException e) {
      System.err.println("Exception when calling FavoritesApi#call51b5afa6272e746d07f1e0edb5168c85");
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

