package com.monkeybit.routability;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.TextView;
import android.widget.Toast;


import com.android.volley.VolleyError;

import org.json.JSONObject;

import java.util.Objects;


public class searchActivity extends Fragment implements View.OnClickListener{

    private String petition;
    Button search;
    RadioButton radioButtonFilterPlaces;
    RadioButton radioButtonFilterRoutes;

    EditText wordsFromSearchBox;
    CheckBox checkForeigner;
    CheckBox checkRedVision;
    CheckBox checkRedMovility;
    CheckBox checkDeaf;
    CheckBox checkColorBlind;

    boolean imInFav;


    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {


        // Inflate the layout for this fragment
        super.onCreateView(inflater, container, savedInstanceState);
        final View rootview =  inflater.inflate(R.layout.activity_search, container, false);

        radioButtonFilterRoutes = rootview.findViewById(R.id.filterCheckBoxRoutes);
        radioButtonFilterPlaces = rootview.findViewById(R.id.filterCheckBoxPlaces);

        wordsFromSearchBox = rootview.findViewById(R.id.searchBox);
        checkForeigner = rootview.findViewById(R.id.filterCheckBoxForeigner);
        checkRedVision = rootview.findViewById(R.id.filterCheckBoxRedvision);
        checkRedMovility = rootview.findViewById(R.id.filterCheckBoxRedmovility);
        checkDeaf = rootview.findViewById(R.id.filterCheckBoxDeaf);
        checkColorBlind = rootview.findViewById(R.id.filterCheckBoxColorblind);

        //Toast.makeText(getContext(), imInFav+"", Toast.LENGTH_SHORT).show();

        petition = "";

        search = rootview.findViewById(R.id.searchButton);
        search.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // ADEMAS HAZLE UN getPetition() A CADA UNO PARA ENVIARLE LA PETICION
                if(radioButtonFilterRoutes.isChecked()){
                    fillPetitionForRoute();
                    if(imInFav == true)
                        fillPetitionFav();
                    Fragment selectedFragment = new SearchRoutesResult();
                    ((SearchRoutesResult) selectedFragment).setPetition(petition);
                    getFragmentManager().beginTransaction().replace(R.id.frame_rp_view, selectedFragment).commit();
                    //Toast.makeText(getContext(), "Test", Toast.LENGTH_SHORT).show();

                }else{
                    fillPetitionForPlace();
                    Fragment selectedFragment = new SearchPlacesResult();
                    if(imInFav == true)
                        fillPetitionFav();
                    ((SearchPlacesResult) selectedFragment).setPetition(petition);
                    getFragmentManager().beginTransaction().replace(R.id.frame_rp_view, selectedFragment).commit();
                    //Toast.makeText(getContext(), "Test", Toast.LENGTH_SHORT).show();
                    //Toast.makeText(getContext(), petition, Toast.LENGTH_SHORT).show();
                }
            }
        });

        return rootview;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.searchButton:
                Fragment selectedFragment = new SearchPlacesResult();
                getFragmentManager().beginTransaction().replace(R.id.frame_rp_view, selectedFragment).commit();

                break;
        }
    }

    private void fillPetitionForPlace(){
        petition +=  wordsFromSearchBox.getText().toString();

        if(checkForeigner.isChecked())
            petition += "&Foreigner=1";
        if(checkColorBlind.isChecked())
            petition += "&ColourBlind=1";
        if(checkDeaf.isChecked())
            petition += "&Deaf=1";
        if(checkRedMovility.isChecked())
            petition += "&RedMovility=1";
        if(checkRedVision.isChecked())
            petition += "&RedVision=1";

        petition = petition.replaceAll(" ", "%20");
    }

    private void fillPetitionForRoute(){
        petition +=  wordsFromSearchBox.getText().toString();

        petition = petition.replaceAll(" ", "%20");
    }

    public void setFav(boolean fav){
        this.imInFav = fav;
    }

    private void fillPetitionFav(){
        String user = ((MainActivity) Objects.requireNonNull(getActivity())).getUserEmail();

        petition += "&Email=" + user.toString();
    }

    /*
    public void replaceFragment(Fragment someFragment) {
        FragmentTransaction transaction = getFragmentManager().beginTransaction();

        transaction.replace(R.id.home, someFragment);
        transaction.addToBackStack(null);
        transaction.commit();
    }*/
}
