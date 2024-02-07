# InfoApi

All URIs are relative to *http://localhost*

Method | HTTP request | Description
------------- | ------------- | -------------
[**cf951e643228746449d03cd83b188980**](InfoApi.md#cf951e643228746449d03cd83b188980) | **GET** / | 


<a name="cf951e643228746449d03cd83b188980"></a>
# **cf951e643228746449d03cd83b188980**
> cf951e643228746449d03cd83b188980()



### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.InfoApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    InfoApi apiInstance = new InfoApi(defaultClient);
    try {
      apiInstance.cf951e643228746449d03cd83b188980();
    } catch (ApiException e) {
      System.err.println("Exception when calling InfoApi#cf951e643228746449d03cd83b188980");
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
**200** | API version |  -  |

