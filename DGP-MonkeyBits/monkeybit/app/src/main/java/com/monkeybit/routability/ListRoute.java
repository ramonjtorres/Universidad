package com.monkeybit.routability;

import android.annotation.SuppressLint;



public class ListRoute {
    //This class is the structure of the route
    private String idImage;
    private String tittle;
    private String description;
    private double rating;
    private double people;
    private String imageDescription;
    String idRoute;

    public ListRoute(){

    }


    @SuppressLint("ValidFragment")
    public ListRoute (String idImage, String tittle, String description,String id,String imageDescription) {
        this.idImage = idImage;
        this.tittle = tittle;
        this.description = description;
        rating = 0;
        people = 0;
        this.idRoute = id;
        this.imageDescription = imageDescription;
    }

    @SuppressLint("ValidFragment")
    public ListRoute (String idImage, String tittle, String description,String id) {
        this.idImage = idImage;
        this.tittle = tittle;
        this.description = description;
        rating = 0;
        people = 0;
        this.idRoute = id;
    }

    public String get_Tittle() {
        return tittle;
    }

    public String get_Description() {
        return description;
    }

    public String get_idImagen() {
        return idImage;
    }

    public String get_idRoute(){
        return idRoute;
    }

    public String getImageDescription() {
        return imageDescription;
    }

    //people
    public void SetRating(double rat){
        rating = rating + rat;
        people += 1;
    }

    public double get_Rating(){
        return rating/people;
    }

}
