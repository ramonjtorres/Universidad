package com.monkeybit.routability;

import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Route {

    private String idRoute, email;
    protected String madeBy, name, description, image,descImagen;
    protected ArrayList<Place> places = new ArrayList<>();


    public Route() {}

    public Route(String idRoute, String email, String madeBy, String name, String description, String accesibility) {
        this.idRoute = idRoute;
        this.email = email;
        this.madeBy = madeBy;
        this.name = name;
        this.description = description;
        this.image = "";

    }

    public Route(String email, String madeBy, String name, String description, String accesibility) {
        this.idRoute = "";
        this.email = email;
        this.madeBy = madeBy;
        this.name = name;
        this.description = description;
        this.image = "";
    }

    public Route(String idRoute, String name, String description, String image) {
        this.idRoute = "";
        this.email = "";
        this.idRoute = idRoute;
        this.name = name;
        this.description = description;
        this.image = image;
    }


    public Route(JSONObject jsonRoute) {
        if (isValidJson(jsonRoute)) {
            this.setIdRoute(jsonRoute.optString("IdRoute"));
            this.setEmail(jsonRoute.optString("Email"));
            this.setMadeBy(jsonRoute.optString("MadeBy"));
            this.setName(jsonRoute.optString("Name"));
            this.setDescription(jsonRoute.optString("Description"));
            this.setDescriptionImage(jsonRoute.optString("ImageDescription"));
            this.setImage(jsonRoute.optString("Image"));

        }
    }



    public static boolean isValidJson(JSONObject jsonRoute) {
        //@TODO añadir imagen
        return jsonRoute.has("Email") && jsonRoute.has("MadeBy")
                && jsonRoute.has("Name") && jsonRoute.has("Description");
    }

    public JSONObject toJson() {
        JSONObject jsonRoute = new JSONObject();
        try {
            //@TODO añadir imagen
            if (!this.getIdRoute().equals("")) {
                jsonRoute.put("IdRoute", this.getIdRoute());
            }
            jsonRoute.put("Email", this.getEmail());
            jsonRoute.put("MadeBy", this.getMadeBy());
            jsonRoute.put("Name", this.getName());
            jsonRoute.put("Description", this.getDescription());
        } catch (JSONException e) {
            Log.d("DEBUG", "Error al pasar un objeto Route a JSON");
            e.printStackTrace();
        }
        return jsonRoute;
    }

    public JSONArray getPlacesInJson() {
        JSONArray jsonPlaces = new JSONArray();
        JSONObject jsonPlace = new JSONObject();
        try {
            for (Place place : places) {
                jsonPlace.put("IdPlace", place.getIdPlace());
                jsonPlace.put("IdRoute", idRoute);
                jsonPlace.put("Sequence", places.indexOf(place));
                jsonPlaces.put(jsonPlace);
            }
        } catch (JSONException e) {
            Log.d("DEBUG", "Error al pasar la lista de lugares de la ruta a JSON");
            e.printStackTrace();
        }
        return jsonPlaces;
    }

    public String getIdRoute() {
        return idRoute;
    }

    public void setIdRoute(String idRoute) {
        this.idRoute = idRoute;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getMadeBy() {
        return madeBy;
    }

    public void setMadeBy(String madeBy) {
        this.madeBy = madeBy;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public ArrayList<Place> getPlaces() {
        return places;
    }

    public void setPlaces(ArrayList<Place> places) {
        this.places = places;
    }

    public void addPlace(Place newPlace) {
        places.add(newPlace);
    }

    public void removePlace(Place place) {
        places.remove(place);
    }

    public void setDescriptionImage(String description) {
        descImagen = description;
    }

    public String getDescriptionImage() {
        return descImagen;
    }
}
