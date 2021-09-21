package com.monkeybit.routability;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.TextInputEditText;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.VolleyError;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Objects;

public class SuggestRouteActivity extends Fragment implements DBConnectInterface {

    private Button suggestButton;
    private Button nextPageButton;
    private Button previousPageButton;
    private RecyclerView addedPlaces;
    private RecyclerView availablePlaces;
    ArrayList<Place> arrayAddedPlaces = new ArrayList<>();
    ArrayList<Place> arrayAvailablePlaces = new ArrayList<>();
    final PlaceAdapter adapterAddedPlaces = new PlaceAdapter(arrayAddedPlaces);
    final PlaceAdapter adapterAvailablePlaces = new PlaceAdapter(arrayAvailablePlaces);
    private int currentPageIndex = 0;
    View view;
    private TextInputEditText newName;
    private TextInputEditText newDescription;
    private TextInputEditText newImage;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.activity_suggest_route, container, false);

        newName = (TextInputEditText) view.findViewById(R.id.new_name);
        newDescription = (TextInputEditText) view.findViewById(R.id.description);
        newImage = (TextInputEditText) view .findViewById(R.id.image);

        suggestButton = view.findViewById(R.id.suggestButton);
        suggestButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnSuggest(v);
            }
        });

        nextPageButton = view.findViewById(R.id.next_places_button);
        nextPageButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                showNextPage();
            }
        });

        previousPageButton = view.findViewById(R.id.previous_places_button);
        previousPageButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                showPreviousPage();
            }
        });

        addedPlaces = view.findViewById(R.id.added_places);
        LinearLayoutManager lim = new LinearLayoutManager(getContext());
        if(lim != null) {
            lim.setOrientation(LinearLayoutManager.VERTICAL);
            addedPlaces.setLayoutManager(lim);
        }

        availablePlaces = view.findViewById(R.id.available_places);
        LinearLayoutManager lim2 = new LinearLayoutManager(getContext());
        lim.setOrientation(LinearLayoutManager.VERTICAL);
        availablePlaces.setLayoutManager(lim2);

        this.updateCurrentPage();

        this.initializePlaceAdapter(arrayAddedPlaces, addedPlaces, adapterAddedPlaces);
        this.initializePlaceAdapter(arrayAvailablePlaces,availablePlaces, adapterAvailablePlaces);

        return view;
    }

    protected void OnSuggest(android.view.View view) {
        String name = newName.getText().toString();
        String description = newDescription.getText().toString();
        String image = newImage.getText().toString();

        if (!(name.isEmpty() || description.isEmpty() || image.isEmpty() || arrayAddedPlaces.isEmpty())) {
            String userId = ((MainActivity) getActivity()).getUserEmail();
            if (userId != null) {
                RouteToSuggest newRoute = new RouteToSuggest(userId, name, description, image);
                newRoute.setPlaces(arrayAddedPlaces);
                //Toast.makeText(getActivity(), "Json a enviar: " + newRoute.toJson().toString() + "\n" + newRoute.getPlacesInJson().toString(), Toast.LENGTH_SHORT).show();
                try {
                    DBConnect.suggestRoute(getContext(), this, newRoute.toJson(), newRoute.getPlacesInJson());
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                Toast.makeText(getActivity(), "Se enviarán los datos a la base de datos...", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(getContext(), getString(R.string.empty_fields), Toast.LENGTH_SHORT).show();
        }
    }

    @Override
    public void onErrorResponse(VolleyError error) {
        Toast.makeText(getContext(), "Error al sugerir ruta: "+ error, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onResponse(JSONObject response) {
        try {
            for (int i = 0; i < response.getJSONArray("OPERATIONS").length(); i++) {
                String operation = response.getJSONArray("OPERATIONS").getString(i);
                if (response.has(operation)) { // Si no lo cumple, significa que no ha devuelto tuplas
                    if (operation.equals("SUGGEST_ROUTE")) {
                        Toast.makeText(getContext(), getString(R.string.suggested_route), Toast.LENGTH_SHORT).show();
                        Objects.requireNonNull(newImage.getText()).clear();
                        Objects.requireNonNull(this.newName.getText()).clear();
                        Objects.requireNonNull(newDescription.getText()).clear();

                        for(int j=0; j<arrayAddedPlaces.size(); j++) {
                            arrayAvailablePlaces.add(arrayAddedPlaces.get(j));
                            arrayAddedPlaces.remove(j);
                        }
                        updateCurrentPage();
                        updatePlaceAdapter(arrayAddedPlaces, addedPlaces, adapterAddedPlaces);
                        updatePlaceAdapter(arrayAvailablePlaces,availablePlaces, adapterAvailablePlaces);


                    }
                    if (operation.equals("GET_PLACES")) {
                        JSONArray operationResult = response.getJSONArray("GET_PLACES"); // Este elemento tendrá la/s tupla/s
                        this.fillAvailablePlaced(operationResult);
                        this.updatePlaceAdapter(arrayAvailablePlaces, availablePlaces, adapterAvailablePlaces);
                    }
                } else if (operation.equals("GET_PLACES")) {
                    currentPageIndex -=4;
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private void fillAvailablePlaced(JSONArray places) throws JSONException {
        arrayAvailablePlaces.clear();
        for (int i = 0; i < places.length(); i++) {
            Place place = new Place(places.getJSONObject(i));
            // Para no añadir aquellos que ya están en la lista de añadidos (al modificar ruta existente)
            if (!arrayAddedPlaces.contains(place)) {
                arrayAvailablePlaces.add(place);
            }
        }
    }

    public void  updatePlaceAdapter(ArrayList<Place> places, final RecyclerView placeView, final PlaceAdapter adapter){
        if(places.size() >=4){
            placeView.getLayoutParams().height = RecyclerView.LayoutParams.WRAP_CONTENT *4;
        } else if(places.size() < 4){
            placeView.getLayoutParams().height = RecyclerView.LayoutParams.WRAP_CONTENT * places.size(); ///Se coge el wrap content para ajustar el tamaño
        }
        placeView.setAdapter(adapter);
    }

    public void  initializePlaceAdapter(ArrayList<Place> places, final RecyclerView placeView, final PlaceAdapter adapter){
        if(places.size() >=4){
            placeView.getLayoutParams().height = RecyclerView.LayoutParams.WRAP_CONTENT *4;
        } else if(places.size() < 4){
            placeView.getLayoutParams().height = RecyclerView.LayoutParams.WRAP_CONTENT * places.size(); ///Se coge el wrap content para ajustar el tamaño
        }
        adapter.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int position = placeView.getChildAdapterPosition(v); // gets item position
                if (position != RecyclerView.NO_POSITION) { // Check if an item was deleted, but the user clicked it before the UI removed it
                    if(placeView == addedPlaces){
                        arrayAvailablePlaces.add(arrayAddedPlaces.get(position));
                        arrayAddedPlaces.remove(position);
                        updateCurrentPage();
                    }
                    else if(placeView == availablePlaces){
                        arrayAddedPlaces.add(arrayAvailablePlaces.get(position));
                        arrayAvailablePlaces.remove(position);
                        updateCurrentPage();
                    }
                    updatePlaceAdapter(arrayAddedPlaces, addedPlaces, adapterAddedPlaces);
                    updatePlaceAdapter(arrayAvailablePlaces,availablePlaces, adapterAvailablePlaces);
                }
            }
        });
        placeView.setAdapter(adapter);
    }

    private void updateCurrentPage() {
        DBConnect.getPlaces(getContext(), this, currentPageIndex, arrayAddedPlaces);
    }

    private void showNextPage() {
        currentPageIndex += 4;
        DBConnect.getPlaces(getContext(), this, currentPageIndex, arrayAddedPlaces);
    }

    private void showPreviousPage() {
        if (currentPageIndex >= 4) {
            currentPageIndex -= 4;
            if (currentPageIndex < 0) {
                currentPageIndex = 0;
            }
            DBConnect.getPlaces(getContext(), this, currentPageIndex, arrayAddedPlaces);
        } else {
            Toast.makeText(getContext(), "No hay páginas anteriores", Toast.LENGTH_SHORT).show();
        }
    }
}
