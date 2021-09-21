package com.monkeybit.routability;

import android.annotation.SuppressLint;

public class ListPlace {
    private String idImage;
    private String tittle;
    private String description;
    private String imageDescription;
    private String idPlace;

    @SuppressLint("ValidFragment")
    public ListPlace(String idPlace, String idImage, String tittle, String description, String imageDescription ){
        this.idPlace = idPlace;
        this.idImage = idImage;
        this.tittle = tittle;
        this.description = description;
        this.imageDescription = imageDescription;
    }

    public String getIdImage() {
        return idImage;
    }

    public void setIdImage(String idImage) {
        this.idImage = idImage;
    }

    public String getTittle() {
        return tittle;
    }

    public void setTittle(String tittle) {
        this.tittle = tittle;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getImageDescription() {
        return imageDescription;
    }

    public void setImageDescription(String imageDescription) {
        this.imageDescription = imageDescription;
    }

    public String getIdPlace() {
        return idPlace;
    }

    public void setIdPlace(String idPlace) {
        this.idPlace = idPlace;
    }
}
