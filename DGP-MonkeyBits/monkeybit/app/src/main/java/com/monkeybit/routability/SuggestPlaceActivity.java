package com.monkeybit.routability;

import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.TextInputEditText;
import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Switch;
import android.widget.Toast;

import com.android.volley.VolleyError;

import org.json.JSONException;
import org.json.JSONObject;

public class SuggestPlaceActivity extends Fragment implements DBConnectInterface {

    private TextInputEditText newName;
    private TextInputEditText newDescription;
    private TextInputEditText newLocalization;
    private TextInputEditText newImage;
    private Switch newRedMovility;
    private Switch newRedVision;
    private Switch newColourBlind;
    private Switch newDeaf;
    private Switch newForeigner;
    private Button suggestButton;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_suggest_place, container, false);

        newName = (TextInputEditText) view.findViewById(R.id.new_name);
        newDescription = (TextInputEditText) view.findViewById(R.id.description);
        newLocalization = (TextInputEditText) view.findViewById(R.id.localization);
        newImage = (TextInputEditText) view .findViewById(R.id.new_image);
        newRedMovility = (Switch)view.findViewById(R.id.redMovility);
        newRedVision = (Switch)view.findViewById(R.id.redVision);
        newColourBlind = (Switch)view.findViewById(R.id.colourBlind);
        newDeaf = (Switch)view.findViewById(R.id.deaf);
        newForeigner = (Switch)view.findViewById(R.id.foreigner);
        suggestButton = view.findViewById(R.id.suggestButton);
        suggestButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnSuggest(v);
            }
        });

        return view;
    }

    protected void OnSuggest(android.view.View view) {
        String name = newName.getText().toString();
        String description = newDescription.getText().toString();
        String localization = newLocalization.getText().toString();
        String image = newImage.getText().toString();
        boolean redMovility = newRedMovility.isChecked();
        boolean redVision = newRedVision.isChecked();
        boolean colourBlind = newColourBlind.isChecked();
        boolean deaf = newDeaf.isChecked();
        boolean foreigner = newForeigner.isChecked();

        if (!(name.isEmpty() || description.isEmpty() || localization.isEmpty() || image.isEmpty())) {
            String userId = ((MainActivity) getActivity()).getUserEmail();
            if (userId != null) {
                PlaceToSuggest newPlace = new PlaceToSuggest(userId, name, description, localization, image, redMovility, redVision, colourBlind, deaf, foreigner);
                //Toast.makeText(getActivity(), "Json a enviar: " + newPlace.toJson(), Toast.LENGTH_SHORT).show();
                try {
                    DBConnect.suggestPlace(getContext(), this, newPlace.toJson());
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                Toast.makeText(getActivity(), "Se enviarán los datos a la base de datos...", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast toast = Toast.makeText(getActivity(), getString(R.string.empty_fields), Toast.LENGTH_SHORT);
            toast.show();
        }
    }

    @Override
    public void onErrorResponse(VolleyError error) {
        Toast.makeText(getContext(), "Error al sugerir lugar: "+ error, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onResponse(JSONObject response) {
        Toast.makeText(getContext(), getString(R.string.place_suggested), Toast.LENGTH_SHORT).show();
        newName.getText().clear();
        newDescription.getText().clear();
        newLocalization.getText().clear();
        newImage.getText().clear();

    }
}
