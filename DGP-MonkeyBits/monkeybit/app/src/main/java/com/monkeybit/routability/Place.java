package com.monkeybit.routability;

import android.util.Log;

import org.json.JSONException;
import org.json.JSONObject;

public class Place {

    private String idPlace, email;
    protected String madeBy, name, description, localization, image,imageDesc;
    protected boolean redMovility, redVision, colourBlind, deaf, foreigner;

    public Place(){
        this.redMovility = true;
        this.redVision = true;
        this.colourBlind = true;
        this.deaf = true;
        this.foreigner = true;
    }

    public Place(String idPlace, String email, String madeBy, String name, String description, String localization, String image,
                 boolean redMovility, boolean redVision, boolean colourBlind, boolean deaf, boolean foreigner) {
        this.idPlace = idPlace;
        this.email = email;
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

    public Place(String email, String madeBy, String name, String description, String localization, String image,
                 boolean redMovility, boolean redVision, boolean colourBlind, boolean Deaf, boolean foreigner) {
        this.idPlace = "";
        this.email = email;
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

    public Place (JSONObject jsonPlace) {
        if (isValidJson(jsonPlace)) {
            this.setIdPlace(jsonPlace.optString("IdPlace"));
            this.setEmail(jsonPlace.optString("Email"));
            this.setMadeBy(jsonPlace.optString("MadeBy"));
            this.setName(jsonPlace.optString("Name"));
            this.setDescription(jsonPlace.optString("Description"));
            this.setLocalization(jsonPlace.optString("Localitation"));
            this.setImage(jsonPlace.optString("Image"));
            this.setRedMovility(jsonPlace.optInt("RedMovility") == 1);
            this.setRedVision(jsonPlace.optInt("RedVision") == 1);
            this.setColourBlind(jsonPlace.optInt("ColourBlind") == 1);
            this.setDeaf(jsonPlace.optInt("Deaf") == 1);
            this.setForeigner(jsonPlace.optInt("Foreigner") == 1);
            this.setDescriptionImage(jsonPlace.optString("ImageDescription"));
        }
    }

    private boolean isValidJson(JSONObject jsonPlace) {
        return jsonPlace.has("IdPlace") && jsonPlace.has("Email") && jsonPlace.has("MadeBy")
                && jsonPlace.has("Name") && jsonPlace.has("Description") && jsonPlace.has("Localitation")
                && jsonPlace.has("Image") && jsonPlace.has("RedMovility") && jsonPlace.has("RedVision")
                && jsonPlace.has("ColourBlind") && jsonPlace.has("Deaf") && jsonPlace.has("Foreigner");
    }

    public JSONObject toJson() {
        JSONObject jsonPlace = new JSONObject();
        try {
            if (!this.getIdPlace().equals("")) {
                jsonPlace.put("IdPlace", this.getIdPlace());
            }
            jsonPlace.put("Email", this.getEmail());
            jsonPlace.put("MadeBy", this.getMadeBy());
            jsonPlace.put("Name", this.getName());
            jsonPlace.put("Description", this.getDescription());
            jsonPlace.put("Localitation", this.getLocalization());
            jsonPlace.put("Image", this.getImage());
            jsonPlace.put("RedMovility", this.isRedMovility());
            jsonPlace.put("RedVision", this.isRedVision());
            jsonPlace.put("ColourBlind", this.isColourBlind());
            jsonPlace.put("Deaf", this.isDeaf());
            jsonPlace.put("Foreigner", this.isForeigner());
        } catch (JSONException e) {
            Log.d("DEBUG", "Error al pasar un objeto Place a JSON");
            e.printStackTrace();
        }
        return jsonPlace;
    }

    public String getIdPlace() {
        return idPlace;
    }

    public void setIdPlace(String idPlace) {
        this.idPlace = idPlace;
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

    public String getLocalization() {
        return localization;
    }

    public void setLocalization(String localization) {
        this.localization = localization;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public boolean isRedMovility() {
        return redMovility;
    }

    public void setRedMovility(boolean redMovility) {
        this.redMovility = redMovility;
    }

    public boolean isRedVision() {
        return redVision;
    }

    public void setRedVision(boolean redVision) {
        this.redVision = redVision;
    }

    public boolean isColourBlind() {
        return colourBlind;
    }

    public void setColourBlind(boolean colourBlind) {
        this.colourBlind = colourBlind;
    }

    public boolean isDeaf() {
        return deaf;
    }

    public void setDeaf(boolean deaf) {
        this.deaf = deaf;
    }

    public boolean isForeigner() {
        return foreigner;
    }

    public void setForeigner(boolean foreigner) {
        this.foreigner = foreigner;
    }

    public void setDescriptionImage(String description) {
        imageDesc = description;
    }

    public String getDescriptionImage() {
        return imageDesc;
    }
    @Override
    public boolean equals(Object obj) {
        return this.getIdPlace().equals(((Place) obj).getIdPlace());
    }
}
