package com.monkeybit.routability;

import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class RouteToSuggest extends Route {

    public RouteToSuggest(String madeBy, String name, String description, String image) {
        this.madeBy = madeBy;
        this.name = name;
        this.description = description;
        this.image = image;
    }

    public RouteToSuggest(JSONObject jsonRoute) {
        if (isValidJson(jsonRoute)) {
            this.setMadeBy(jsonRoute.optString("MadeBy"));
            this.setName(jsonRoute.optString("Name"));
            this.setDescription(jsonRoute.optString("Description"));
            this.setDescription(jsonRoute.optString("Imagen"));
        }
    }

    public static boolean isValidJson(JSONObject jsonRoute) {
        return jsonRoute.has("MadeBy") && jsonRoute.has("Name")
                && jsonRoute.has("Description") && jsonRoute.has("Image");
    }

    public JSONObject toJson() {
        JSONObject jsonRoute = new JSONObject();
        try {
            //@TODO añadir imagen
            jsonRoute.put("MadeBy", this.getMadeBy());
            jsonRoute.put("Name", this.getName());
            jsonRoute.put("Description", this.getDescription());
            jsonRoute.put("Image", this.getImage());
        } catch (JSONException e) {
            Log.d("DEBUG", "Error al pasar un objeto RouteToSuggest a JSON");
            e.printStackTrace();
        }
        return jsonRoute;
    }

    public JSONArray getPlacesInJson() {
        JSONArray jsonPlaces = new JSONArray();
        try {
            for (Place place : places) {
                JSONObject jsonPlace = new JSONObject();
                jsonPlace.put("IdPlace", place.getIdPlace());
                jsonPlace.put("Sequence", places.indexOf(place));
                jsonPlaces.put(jsonPlace);
            }
        } catch (JSONException e) {
            Log.d("DEBUG", "Error al pasar la lista de lugares de la ruta a JSON");
            e.printStackTrace();
        }
        return jsonPlaces;
    }
}
