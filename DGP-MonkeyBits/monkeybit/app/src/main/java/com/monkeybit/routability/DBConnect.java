package com.monkeybit.routability;

import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.util.ArrayList;

public final class DBConnect {

    private static final String serverIP =  "192.168.1.43";
    private static final String folderName =  "RoutabilityAdmin";

    private DBConnect() {}

    public static void getPlace(Context context, DBConnectInterface responseListener, String placeId) {
        String url = "http://" + serverIP + "/" + folderName + "/getPlace.php?IdPlace=" + placeId;
        getTuple(context, responseListener, url);
    }

    public static void addPlaceComment(Context context, DBConnectInterface responseListener, String placeId, String email, String content){
        String url = "http://" + serverIP + "/" + folderName + "/addPlaceComment.php?IdPlace=" + placeId + "&Email=" + email + "&Content=" + content;
        addTuple(context, responseListener, url);
    }

    public static void hasVisited(Context context, DBConnectInterface responseListener, String placeId, String email){
        String url = "http://" + serverIP + "/" + folderName + "/hasVisited.php?IdPlace=" + placeId + "&Email=" + email;
        updateTuple(context, responseListener, url);
    }

    public static void reportPlaceComment(Context context, DBConnectInterface responseListener, String placeId, String email, String date, String time){
        String url = "http://" + serverIP + "/" + folderName + "/reportPlaceComment.php?IdPlace=" + placeId + "&Email=" + email + "&Date=" + date + "&Time=" + time;
        addTuple(context, responseListener, url);
    }

    public static void reportRouteComment(Context context, DBConnectInterface responseListener, String placeId, String email, String date, String time){
        String url = "http://" + serverIP + "/" + folderName + "/reportRouteComment.php?IdRoute=" + placeId + "&Email=" + email + "&Date=" + date + "&Time=" + time;
        addTuple(context, responseListener, url);
    }

    public static void getAverageScorePlace(Context context, DBConnectInterface responseListener, String placeId) {
        String url = "http://" + serverIP + "/" + folderName + "/getAverageScorePlace.php?IdPlace=" + placeId;
        getTuple(context, responseListener, url);
    }

    public static void getAverageScoreRoute(Context context, DBConnectInterface responseListener, String routeId) {
        String url = "http://" + serverIP + "/" + folderName + "/getAverageScoreRoute.php?IdRoute=" + routeId;
        getTuple(context, responseListener, url);
    }

    public static void getPlaceComments(Context context, DBConnectInterface responseListener, String placeId) {
        String url = "http://" + serverIP + "/" + folderName + "/getPlaceComments.php?IdPlace=" + placeId;
        getTuple(context, responseListener, url);
    }
    public static void getRouteComments(Context context, DBConnectInterface responseListener, String routeId){
        String url = "http://" + serverIP + "/" + folderName + "/getRouteComments.php?IdRoute=" + routeId;
        getTuple(context, responseListener, url);
    }
    public static void addRouteComment(Context context, DBConnectInterface responseListener, String routeId, String email, String content){
        String url = "http://" + serverIP + "/" + folderName + "/addRouteComment.php?IdRoute=" + routeId + "&Email=" + email + "&Content=" + content;
        addTuple(context, responseListener, url);
    }

    public static void getPlaces(Context context, DBConnectInterface responseListener, int firstPlaceIndex) {
        String url = "http://" + serverIP + "/" + folderName + "/getPlaces.php?Start=" + firstPlaceIndex;
        getTuple(context, responseListener, url);
    }
    public static void getPlaces(Context context, DBConnectInterface responseListener, int firstPlaceIndex, ArrayList<Place> placesException) {
        String url = "http://" + serverIP + "/" + folderName + "/getPlaces.php?Start=" + firstPlaceIndex;
        if (!placesException.isEmpty()) {
            JSONArray jsonPlacesException = new JSONArray();
            for (Place place : placesException) {
                jsonPlacesException.put(place.getIdPlace());
            }
            try {
                url += "&PlacesException=" + URLEncoder.encode(jsonPlacesException.toString(), "utf-8");
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
                Log.d("ERROR", e.toString());
            }
        }
        getTuple(context, responseListener, url);
    }

    public static void getFavoritePlaces(Context context, DBConnectInterface responseListener, String userEmail) {
        String url = "http://" + serverIP + "/" + folderName + "/getFavoritePlaces.php?Email=" + userEmail;
        addTuple(context, responseListener, url);
    }

    public static void removeFavoritePlace(Context context, DBConnectInterface responseListener, String userEmail, String placeId) {
        String url = "http://" + serverIP + "/" + folderName + "/removeFavoritePlace.php?Email=" + userEmail + "&IdPlace=" + placeId;
        getTuple(context, responseListener, url);
    }

    public static void addAsFavoritePlace(Context context, DBConnectInterface responseListener, String userEmail, String placeId) {
        String url = "http://" + serverIP + "/" + folderName + "/addFavoritePlace.php?Email=" + userEmail + "&IdPlace=" + placeId;
        getTuple(context, responseListener, url);
    }

    public static void suggestPlace(Context context, DBConnectInterface responseListener, JSONObject suggestedPlace) throws JSONException {
        String suggestedPlaceUrl = "";
        suggestedPlaceUrl += "MadeBy=" + suggestedPlace.getString("MadeBy");
        suggestedPlaceUrl += "&Name=" + suggestedPlace.getString("Name");
        suggestedPlaceUrl += "&Description=" + suggestedPlace.getString("Description");
        suggestedPlaceUrl += "&Localitation=" + suggestedPlace.getString("Localization");
        suggestedPlaceUrl += "&Image=" + suggestedPlace.getString("Image");
        suggestedPlaceUrl += "&RedMovility=" + (suggestedPlace.getBoolean("RedMovility") ? Integer.toString(1) : Integer.toString(0));
        suggestedPlaceUrl += "&RedVision=" + (suggestedPlace.getBoolean("RedVision") ? Integer.toString(1) : Integer.toString(0));
        suggestedPlaceUrl += "&ColourBlind=" + (suggestedPlace.getBoolean("ColourBlind") ? Integer.toString(1) : Integer.toString(0));
        suggestedPlaceUrl += "&Deaf=" + (suggestedPlace.getBoolean("Deaf") ? Integer.toString(1) : Integer.toString(0));
        suggestedPlaceUrl += "&Foreigner=" + (suggestedPlace.getBoolean("Foreigner") ? Integer.toString(1) : Integer.toString(0));
        String url = "http://" + serverIP + "/" + folderName + "/suggestPlace.php?" + suggestedPlaceUrl;
        addTuple(context, responseListener, url);
    }

    public static void getRoute(Context context, DBConnectInterface responseListener, String routeId) {
        String url = "http://" + serverIP + "/" + folderName + "/getRoute.php?IdRoute=" + routeId;
        getTuple(context, responseListener, url);
    }

    public static void getRoutes(Context context, DBConnectInterface responseListener, int firstRouteIndex) {
        String url = "http://" + serverIP + "/" + folderName + "/getRoutes.php?Start=" + firstRouteIndex;
        getTuple(context, responseListener, url);
    }

    public static void getFavoriteRoutes(Context context, DBConnectInterface responseListener, String userEmail) {
        String url = "http://" + serverIP + "/" + folderName + "/getFavoriteRoutes.php?Email=" + userEmail;
        getTuple(context, responseListener, url);
    }

    public static void removeFavoriteRoutes(Context context, DBConnectInterface responseListener, String userEmail, String routeId) {
        String url = "http://" + serverIP + "/" + folderName + "/removeFavoriteRoute.php?Email=" + userEmail + "&IdRoute=" + routeId;
        getTuple(context, responseListener, url);
    }

    public static void addAsFavoriteRoute(Context context, DBConnectInterface responseListener, String userEmail, String routeId) {
        String url = "http://" + serverIP + "/" + folderName + "/addFavoriteRoute.php?Email=" + userEmail + "&IdRoute="+ routeId;
        addTuple(context, responseListener, url);
    }

    public static void suggestRoute(Context context, DBConnectInterface responseListener, JSONObject suggestedRoute, JSONArray places) throws JSONException {
        String suggestedRouteUrl = "";
        suggestedRouteUrl += "MadeBy=" + suggestedRoute.getString("MadeBy");
        suggestedRouteUrl += "&Name=" + suggestedRoute.getString("Name");
        suggestedRouteUrl += "&Description=" + suggestedRoute.getString("Description");
        suggestedRouteUrl += "&Image=" + suggestedRoute.getString("Image");
        try {
            suggestedRouteUrl += "&Places=" + URLEncoder.encode(places.toString(), "utf-8");
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
            Log.d("ERROR", e.toString());
        }
        String url = "http://" + serverIP + "/" + folderName + "/suggestRoute.php?" + suggestedRouteUrl;
        addTuple(context, responseListener, url);
    }

    public static void addUser(Context context, DBConnectInterface responseListener, String userEmail, String userName) {
        String url = "http://" + serverIP + "/" + folderName + "/addUser.php?Email=" + userEmail + "&Name="+ userName;
        addTuple(context, responseListener, url);
    }

    private static void getTuple(Context context, DBConnectInterface responseListener, String url) {
        url = url.replaceAll(" ", "%20");
        Log.d("URL_DBConnect", url);
        RequestQueue requestQueue = Volley.newRequestQueue(context);
        JsonRequest jsonRequest = new JsonObjectRequest(Request.Method.POST, url, null, responseListener, responseListener);
        requestQueue.add(jsonRequest);
    }

    private static void addTuple(Context context, DBConnectInterface responseListener, String url) {
        url = url.replaceAll(" ", "%20");
        Log.d("URL_DBConnect", url);
        RequestQueue requestQueue = Volley.newRequestQueue(context);
        JsonRequest jsonRequest = new JsonObjectRequest(Request.Method.PUT, url, null, responseListener, responseListener);
        requestQueue.add(jsonRequest);
    }

    private static void updateTuple(Context context, DBConnectInterface responseListener, String url) {
        url = url.replaceAll(" ", "%20");
        Log.d("URL_DBConnect", url);
        RequestQueue requestQueue = Volley.newRequestQueue(context);
        JsonRequest jsonRequest = new JsonObjectRequest(Request.Method.PUT, url, null, responseListener, responseListener);
        requestQueue.add(jsonRequest);
    }

    public static void searchByName(Context context, DBConnectInterface responseListener, String search){
        String url = "http://" + serverIP + "/" + folderName + "/searchByName.php?Search=" + search;
        getTuple(context, responseListener, url);
    }

    public static void searchRoutesByName(Context context, DBConnectInterface responseListener, String search){
        String url = "http://" + serverIP + "/" + folderName + "/searchRoutesByName.php?Search=" + search;
        getTuple(context, responseListener, url);
    }

    public static void searchPlacesByName(Context context, DBConnectInterface responseListener, String search){
        String url = "http://" + serverIP + "/" + folderName + "/searchPlacesByName.php?Search=" + search;
        getTuple(context, responseListener, url);
    }
}

