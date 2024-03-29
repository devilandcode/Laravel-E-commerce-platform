/*
 * DashBoard Api
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


package org.openapitools.client.api;

import org.openapitools.client.ApiCallback;
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.ApiResponse;
import org.openapitools.client.Configuration;
import org.openapitools.client.Pair;
import org.openapitools.client.ProgressRequestBody;
import org.openapitools.client.ProgressResponseBody;

import com.google.gson.reflect.TypeToken;

import java.io.IOException;



import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class ProfileApi {
    private ApiClient localVarApiClient;

    public ProfileApi() {
        this(Configuration.getDefaultApiClient());
    }

    public ProfileApi(ApiClient apiClient) {
        this.localVarApiClient = apiClient;
    }

    public ApiClient getApiClient() {
        return localVarApiClient;
    }

    public void setApiClient(ApiClient apiClient) {
        this.localVarApiClient = apiClient;
    }

    /**
     * Build call for call4d471f45098fecbafcd2f589b41448ec
     * @param name User&#39;s name (required)
     * @param lastName User&#39;s last name (required)
     * @param password User&#39;s phone (required)
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call call4d471f45098fecbafcd2f589b41448ecCall(String name, String lastName, String password, final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/user";

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        if (name != null) {
            localVarQueryParams.addAll(localVarApiClient.parameterToPair("name", name));
        }

        if (lastName != null) {
            localVarQueryParams.addAll(localVarApiClient.parameterToPair("last_name", lastName));
        }

        if (password != null) {
            localVarQueryParams.addAll(localVarApiClient.parameterToPair("password", password));
        }

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] {  };
        return localVarApiClient.buildCall(localVarPath, "PUT", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call call4d471f45098fecbafcd2f589b41448ecValidateBeforeCall(String name, String lastName, String password, final ApiCallback _callback) throws ApiException {
        
        // verify the required parameter 'name' is set
        if (name == null) {
            throw new ApiException("Missing the required parameter 'name' when calling call4d471f45098fecbafcd2f589b41448ec(Async)");
        }
        
        // verify the required parameter 'lastName' is set
        if (lastName == null) {
            throw new ApiException("Missing the required parameter 'lastName' when calling call4d471f45098fecbafcd2f589b41448ec(Async)");
        }
        
        // verify the required parameter 'password' is set
        if (password == null) {
            throw new ApiException("Missing the required parameter 'password' when calling call4d471f45098fecbafcd2f589b41448ec(Async)");
        }
        

        okhttp3.Call localVarCall = call4d471f45098fecbafcd2f589b41448ecCall(name, lastName, password, _callback);
        return localVarCall;

    }

    /**
     * 
     * 
     * @param name User&#39;s name (required)
     * @param lastName User&#39;s last name (required)
     * @param password User&#39;s phone (required)
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public void call4d471f45098fecbafcd2f589b41448ec(String name, String lastName, String password) throws ApiException {
        call4d471f45098fecbafcd2f589b41448ecWithHttpInfo(name, lastName, password);
    }

    /**
     * 
     * 
     * @param name User&#39;s name (required)
     * @param lastName User&#39;s last name (required)
     * @param password User&#39;s phone (required)
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> call4d471f45098fecbafcd2f589b41448ecWithHttpInfo(String name, String lastName, String password) throws ApiException {
        okhttp3.Call localVarCall = call4d471f45098fecbafcd2f589b41448ecValidateBeforeCall(name, lastName, password, null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     *  (asynchronously)
     * 
     * @param name User&#39;s name (required)
     * @param lastName User&#39;s last name (required)
     * @param password User&#39;s phone (required)
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call call4d471f45098fecbafcd2f589b41448ecAsync(String name, String lastName, String password, final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = call4d471f45098fecbafcd2f589b41448ecValidateBeforeCall(name, lastName, password, _callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
    /**
     * Build call for call6526a7845e1078d2ca4047f9dfeb7388
     * @param name User&#39;s name (required)
     * @param email User&#39;s email (required)
     * @param password User&#39;s password (required)
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> User registered successfully </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call call6526a7845e1078d2ca4047f9dfeb7388Call(String name, String email, String password, final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/register";

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        if (name != null) {
            localVarQueryParams.addAll(localVarApiClient.parameterToPair("name", name));
        }

        if (email != null) {
            localVarQueryParams.addAll(localVarApiClient.parameterToPair("email", email));
        }

        if (password != null) {
            localVarQueryParams.addAll(localVarApiClient.parameterToPair("password", password));
        }

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] {  };
        return localVarApiClient.buildCall(localVarPath, "POST", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call call6526a7845e1078d2ca4047f9dfeb7388ValidateBeforeCall(String name, String email, String password, final ApiCallback _callback) throws ApiException {
        
        // verify the required parameter 'name' is set
        if (name == null) {
            throw new ApiException("Missing the required parameter 'name' when calling call6526a7845e1078d2ca4047f9dfeb7388(Async)");
        }
        
        // verify the required parameter 'email' is set
        if (email == null) {
            throw new ApiException("Missing the required parameter 'email' when calling call6526a7845e1078d2ca4047f9dfeb7388(Async)");
        }
        
        // verify the required parameter 'password' is set
        if (password == null) {
            throw new ApiException("Missing the required parameter 'password' when calling call6526a7845e1078d2ca4047f9dfeb7388(Async)");
        }
        

        okhttp3.Call localVarCall = call6526a7845e1078d2ca4047f9dfeb7388Call(name, email, password, _callback);
        return localVarCall;

    }

    /**
     * 
     * 
     * @param name User&#39;s name (required)
     * @param email User&#39;s email (required)
     * @param password User&#39;s password (required)
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> User registered successfully </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public void call6526a7845e1078d2ca4047f9dfeb7388(String name, String email, String password) throws ApiException {
        call6526a7845e1078d2ca4047f9dfeb7388WithHttpInfo(name, email, password);
    }

    /**
     * 
     * 
     * @param name User&#39;s name (required)
     * @param email User&#39;s email (required)
     * @param password User&#39;s password (required)
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> User registered successfully </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> call6526a7845e1078d2ca4047f9dfeb7388WithHttpInfo(String name, String email, String password) throws ApiException {
        okhttp3.Call localVarCall = call6526a7845e1078d2ca4047f9dfeb7388ValidateBeforeCall(name, email, password, null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     *  (asynchronously)
     * 
     * @param name User&#39;s name (required)
     * @param email User&#39;s email (required)
     * @param password User&#39;s password (required)
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 201 </td><td> User registered successfully </td><td>  -  </td></tr>
        <tr><td> 422 </td><td> Validation errors </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call call6526a7845e1078d2ca4047f9dfeb7388Async(String name, String email, String password, final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = call6526a7845e1078d2ca4047f9dfeb7388ValidateBeforeCall(name, email, password, _callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
    /**
     * Build call for e8e42fa22aeacc6854b2347f08f9c761
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call e8e42fa22aeacc6854b2347f08f9c761Call(final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/user";

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] {  };
        return localVarApiClient.buildCall(localVarPath, "GET", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call e8e42fa22aeacc6854b2347f08f9c761ValidateBeforeCall(final ApiCallback _callback) throws ApiException {
        

        okhttp3.Call localVarCall = e8e42fa22aeacc6854b2347f08f9c761Call(_callback);
        return localVarCall;

    }

    /**
     * 
     * 
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
     </table>
     */
    public void e8e42fa22aeacc6854b2347f08f9c761() throws ApiException {
        e8e42fa22aeacc6854b2347f08f9c761WithHttpInfo();
    }

    /**
     * 
     * 
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> e8e42fa22aeacc6854b2347f08f9c761WithHttpInfo() throws ApiException {
        okhttp3.Call localVarCall = e8e42fa22aeacc6854b2347f08f9c761ValidateBeforeCall(null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     *  (asynchronously)
     * 
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td> Success response </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call e8e42fa22aeacc6854b2347f08f9c761Async(final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = e8e42fa22aeacc6854b2347f08f9c761ValidateBeforeCall(_callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
}
