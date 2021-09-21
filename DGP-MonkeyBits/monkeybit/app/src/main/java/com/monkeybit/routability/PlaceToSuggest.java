package com.monkeybit.routability;

import android.util.Log;

import org.json.JSONException;
import org.json.JSONObject;

public class PlaceToSuggest extends Place {

    public PlaceToSuggest(){
        super();
    }

    public PlaceToSuggest(String madeBy, String name, String description, String localization, String image,
                          boolean redMovility, boolean redVision, boolean colourBlind, boolean Deaf, boolean foreigner) {
        this.madeBy = madeBy;
        this.name = name;
        this.description = description;
        this.localization = localization;
        this.image = image;
        this.redMovility = redMovility;
        this.redVision = redVision;
        this.colourBlind = colourBlind;
        this.deaf = deaf;
        this.foreigner = foreigner;
    }

    public PlaceToSuggest (JSONObject jsonPlace) {
        if (isValidJson(jsonPlace)) {
            this.setMadeBy(jsonPlace.optString("MadeBy"));
            this.setName(jsonPlace.optString("Name"));
            this.setDescription(jsonPlace.optString("Description"));
            this.setLocalization(jsonPlace.optString("Localization"));
            this.setImage(jsonPlace.optString("Image"));
            this.setRedMovility(jsonPlace.optInt("RedMovility") == 1);
            this.setRedVision(jsonPlace.optInt("RedVision") == 1);
            this.setColourBlind(jsonPlace.optInt("ColourBlind") == 1);
            this.setDeaf(jsonPlace.optInt("Dead") == 1);
            this.setForeigner(jsonPlace.optInt("Foreigner") == 1);
        }
    }

    private boolean isValidJson(JSONObject jsonPlace) {
        return jsonPlace.has("MadeBy") && jsonPlace.has("Name")
                && jsonPlace.has("Description") && jsonPlace.has("Localization") && jsonPlace.has("Image")
                && jsonPlace.has("RedMovility") && jsonPlace.has("RedVision") && jsonPlace.has("ColourBlind")
                && jsonPlace.has("Deaf") && jsonPlace.has("Foreigner");
    }

    public JSONObject toJson() {
        JSONObject jsonPlace = new JSONObject();
        try {
            jsonPlace.put("MadeBy", this.getMadeBy());
            jsonPlace.put("Name", this.getName());
            jsonPlace.put("Description", this.getDescription());
            jsonPlace.put("Localization", this.getLocalization());
            jsonPlace.put("Image", this.getImage());
            jsonPlace.put("RedMovility", this.isRedMovility());
            jsonPlace.put("RedVision", this.isRedVision());
            jsonPlace.put("ColourBlind", this.isColourBlind());
            jsonPlace.put("Deaf", this.isDeaf());
            jsonPlace.put("Foreigner", this.isForeigner());
        } catch (JSONException e) {
            Log.d("DEBUG", "Error al pasar un objeto PlaceToSuggest a JSON");
            e.printStackTrace();
        }
        return jsonPlace;
    }
}

