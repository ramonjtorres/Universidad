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
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;


import com.android.volley.VolleyError;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;


public class RouteView extends Fragment implements DBConnectInterface{
    View view;
    String choosen = null;
    private Button nextPageButton,previousPageButton;
    private List<Comments> comments = new ArrayList<>();
    private RecyclerView listComments;
    private ArrayList<Place> places;
    private ArrayList<Place> placesShown;
    private CommentsAdapter adapter;
    private int result = 0;
    private boolean isFavorite = false;
    private String email;
    private ImageButton favButton;
    private DBConnectInterface dbInter;
    private TextInputEditText commentText;
    private int tam= 4;

    private int currentPageIndex = 0;


    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        view = inflater.inflate(R.layout.view_rute, container, false);
        //Receive the id
        choosen = getArguments().getString("routeId");

        email = ((MainActivity) getActivity()).getUserEmail();
        dbInter = this;
        places = null;
            DBConnect.getFavoriteRoutes(getContext(), this,email);
            favButton = view.findViewById(R.id.posRtFav);
            favButton.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    if (email != null) {
                        if (isFavorite) {
                            removeFavoriteRoute();
                        } else {
                            addFavoriteRoute();
                        }
                    } else {
                        Toast.makeText(getContext(), R.string.should_login, Toast.LENGTH_SHORT).show();
                    }
                }
            });


        final Button button = view.findViewById(R.id.postFollowBtRt);
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Code here executes on main thread after user presses button
                //@Todo enviar a map
                String aux = "Map";
                Toast info = Toast.makeText(getContext(),aux,Toast.LENGTH_SHORT);
                info.show();
            }
        });

        commentText = view.findViewById(R.id.myCommentRoute);

        Button button2 = view.findViewById(R.id.sendComment);
        button2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(choosen != null){
                    if(email != null && !commentText.getText().toString().equals("")){
                        Toast.makeText(getContext(), "Enviando comentario", Toast.LENGTH_SHORT).show();
                        addComment();
                    }
                    else if(email == null){
                        Toast.makeText(getContext(), R.string.should_login, Toast.LENGTH_SHORT).show();
                    }
                    else if(commentText.getText().toString().equals("")){
                        Toast.makeText(getContext(), R.string.empty_fields, Toast.LENGTH_SHORT).show();
                    }
                }

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


        listComments = view.findViewById(R.id.list_comments);
        LinearLayoutManager lim = new LinearLayoutManager(getContext());
        lim.setOrientation(LinearLayoutManager.VERTICAL);
        listComments.setLayoutManager(lim);

        initializedAdapter();

        DBConnect.getRoute(getContext(),this,choosen);

        return view;
        // return super.onCreateView(inflater, container, savedInstanceState);
    }
    public void addComment(){
        DBConnect.addRouteComment(getContext(),this,choosen,email,commentText.getText().toString());
    }

    public void addFavoriteRoute(){
        DBConnect.addAsFavoriteRoute(getContext(), this, email, choosen);
    }

    public void removeFavoriteRoute(){
        DBConnect.removeFavoriteRoutes(getContext(), this, email, choosen);
    }

    protected void Conf_List_Route(ArrayList<Place> dataList) {

        if(dataList != null){
            ListView list = view.findViewById(R.id.postListLug);
            //adapt to the list
            if(placesShown.size() >=4){
                list.getLayoutParams().height = RecyclerView.LayoutParams.WRAP_CONTENT *4;
            } else if(placesShown.size() < 4){
                list.getLayoutParams().height = RecyclerView.LayoutParams.WRAP_CONTENT * places.size(); ///Se coge el wrap content para ajustar el tamaño
            }

            list.setAdapter(new AdapterList(getContext(), R.layout.post_rute, dataList) {
                @Override
                public void onPost(Object post, View view) {
                    if (post != null) {
                        TextView pt_tittle = view.findViewById(R.id.post_tittle);
                        if (pt_tittle != null)
                            pt_tittle.setText(((Place) post).getName());

                        TextView pt_desc = view.findViewById(R.id.post_desc);
                        if (pt_desc != null)
                            pt_desc.setText(((Place) post).getDescription());

                        ImageView image = view.findViewById(R.id.post_img);
                        if (image != null && ((Place) post).getImage() != null){
                                Picasso.get().load(((Place) post).getImage()).into(image);
                        }
                        if(image != null && ((Place) post).getDescriptionImage()!= null){
                            image.setContentDescription(((Place) post).getDescriptionImage());
                        }
                    }

                }
            });

            list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                @Override
                public void onItemClick(AdapterView<?> post, View view, int pos, long id) {
                    //Toast toast = Toast.makeText(getContext()," Pulsado", Toast.LENGTH_SHORT);
                    //toast.show();

                    Place choosen = (Place) post.getItemAtPosition(pos);
                    PlaceView place = new PlaceView();
                    Bundle bundle = new Bundle();
                    bundle.putString("placeId", choosen.getIdPlace());
                    place.setArguments(bundle);

                    if (place != null) {
                        getActivity().getSupportFragmentManager().beginTransaction().replace(R.id.frame_rp_view, place).commit(); //go to the fragment
                    }


                }
            });
        }




    }

    public void initializedAdapter () {
        if(comments.size() >=4){
            listComments.getLayoutParams().height = 1300;
        }
        else{
            listComments.getLayoutParams().height = RecyclerView.LayoutParams.WRAP_CONTENT;
        }
        CommentsAdapter adapter = new CommentsAdapter(comments, getActivity(), getString(R.string.message_ban_place), getString(R.string.message_ban_place_ok), choosen, false);
        listComments.setAdapter(adapter);
    }

    public void setComments(JSONArray query1) throws JSONException {

        for(int i=0; i<query1.length(); i++) {

            JSONObject query = query1.getJSONObject(i);

            //Comments
            String author = "";
            if (query.has("Name")) {
                author = query.optString("Name");
            }

            String email = "";
            if (query.has("Email")) {
                email = query.optString("Email");
            }

            String comment = "";
            if (query.has("Content")) {
                comment = query.optString("Content");
            }

            String date = "";
            if (query.has("Date")) {
                date = query.optString("Date");
            }

            String time = "";
            if (query.has("Time")) {
                time = query.optString("Time");
                comments.add(new Comments(author, comment, date, time, email));
                //Toast.makeText(getContext(), time, Toast.LENGTH_SHORT).show();
            }
        }
        initializedAdapter();
    }


    public void SetView(JSONObject bdelements ) throws JSONException {

            Route ruta = new Route(bdelements);
            TextView tittle = view.findViewById(R.id.postTittleRt);
            if (tittle != null){
               // Log.d("Debug", ruta.getName());
                if(ruta.getName()!=null)
                    tittle.setText(ruta.getName());
            }


            ImageView image = view.findViewById(R.id.imageRoute);
            if (image != null && bdelements.has("Image")){
                if(bdelements.optString("Image") != "")
                    Picasso.get().load(bdelements.optString("Image")).into(image);
            }

            //if(image != null && bdelements.has("ImageDescription")){
            //    image.setContentDescription(bdelements.optString("ImageDescription"));
            //}

            if(image != null && bdelements.has("ImageDescription")){
               image.setContentDescription("Desc");
            }
            TextView description = view.findViewById(R.id.postDescRt);
            if (description != null){
                if(ruta.getDescription() != null)
                    description.setText(ruta.getDescription());
            }


    }

    @Override
    public void onErrorResponse(VolleyError error) {
        Toast.makeText(getContext(), "Error BD: " + error, Toast.LENGTH_SHORT).show();
        result++;
    }

    @Override
    public void onResponse(JSONObject response) {
        try {
            if (response.has("OPERATIONS")) {

                for (int i = 0; i < response.getJSONArray("OPERATIONS").length(); i++) {
                    String operation = response.getJSONArray("OPERATIONS").getString(i);
                    if (response.has(operation)) { // Si no lo cumple, significa que no ha devuelto tuplas

                        if (operation.equals("GET_ROUTE")) {
                            JSONObject operationResult = response.getJSONObject(operation); // Este elemento tendrá la/s tupla/s
                            //Toast.makeText(getContext(), "Lugar\n" + operationResult.toString(), Toast.LENGTH_LONG).show();
                            SetView(operationResult);
                        }
                        if (operation.equals("GET_COMMENTS_FROM_ROUTE")) {
                            JSONArray operationResult = response.getJSONArray(operation); // Este elemento tendrá la/s tupla/s
                            this.setComments(operationResult);
                        }
                        if (operation.equals("GET_AVERAGE_SCORE_ROUTE")) {
                            double aux = -1;
                           try{
                               Double operationResult = response.getDouble(operation);

                                if( !operationResult.isNaN() || operationResult != null ){
                                    aux = operationResult;

                                }
                               SetViewRating(aux);
                           }
                           catch (JSONException e){
                               aux = -1;

                               SetViewRating(aux);
                           }

                        }
                        if (operation.equals("GET_FAVORITE_ROUTES")) {
                            JSONArray operationResult = response.getJSONArray(operation);
                            for (int j = 0; j < operationResult.length(); j++) {
                                JSONObject aux = operationResult.getJSONObject(j);
                                if(aux != null){
                                    String favRoute = aux.getString("IdRoute");
                                    if (choosen.equals(favRoute) && choosen != null) {
                                        setFavButtonState(true);
                                    }
                                }

                            }
                        }
                        if(operation.equals("GET_PLACES_FROM_ROUTE")){

                            JSONArray operationResult = response.getJSONArray(operation);
                            Place aux;
                            places = new ArrayList<>();
                            placesShown = new ArrayList<>();
                            //find and add the place to the list of places
                            for (int j = 0; j < operationResult.length(); j++) {
                                if (operationResult.getJSONObject(j) != null){
                                    aux = new Place(operationResult.getJSONObject(j));
                                    places.add(aux);
                                }
                            }
                            this.fillPlacesNext();


                        }
                    }
                    // Estas operaciones, no necesitan datos de vuelta, por eso no están dentro del if anterior
                    if (operation.equals("ADD_FAVORITE_ROUTE")) {
                        Toast.makeText(getContext(), R.string.added_favorites, Toast.LENGTH_SHORT).show();
                        setFavButtonState(true);
                    }
                    if (operation.equals("REMOVE_FAVORITE_ROUTE")) {
                        Toast.makeText(getContext(), R.string.remove_favorites, Toast.LENGTH_SHORT).show();
                        setFavButtonState(false);
                    }
                    if(operation.equals("ADD_ROUTE_COMMENT")){
                        Log.d("Debug","respuesta add comment");
                        Objects.requireNonNull(this.commentText.getText()).clear();
                        DBConnect.getRouteComments(getContext(),this,choosen);
                    }
                }
                SetView(response);
            } else {
                Toast.makeText(getContext(),"ERROR", Toast.LENGTH_SHORT).show();
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        result ++;

        //@TODO se deberia mejorar esta comprobacion
        if (result >= 0){
            initializedAdapter();
            result = 0;
        }
    }


    private void SetViewRating(double rat){

        TextView rating = view.findViewById(R.id.postRtRating);

        if (rating != null) {

            if(rat == -1){

                rating.setText(getString(R.string.notrating));
            }
            else{

                rating.setText(" "+rat);
            }

        }


    }
    private void setFavButtonState(boolean activate) {
        isFavorite = activate;
        favButton.setSelected(activate);
    }


    //change pag

    private void showNextPage() {
        if(currentPageIndex + tam > places.size())
            currentPageIndex += places.size() % tam;

        else
            currentPageIndex += tam;
    }

    private void showPreviousPage() {
        if (currentPageIndex >= tam) {
            currentPageIndex -= tam;
            if (currentPageIndex < 0) {
                currentPageIndex = 0;
                this.fillPlacesNext();
            }
            else
                this.fillPlacesPrev();

        } else {
            Toast.makeText(getContext(), "No hay páginas anteriores", Toast.LENGTH_SHORT).show();
        }
    }

    private void fillPlacesPrev() {
        placesShown.clear();
        for(int i = currentPageIndex; i < currentPageIndex-tam && i<0 ;i--){
            placesShown.add(places.get(i));
        }
        this.Conf_List_Route(placesShown);
    }

    private void fillPlacesNext() {
        if(currentPageIndex > places.size()){
            Toast.makeText(getContext(), "No hay páginas siguientes", Toast.LENGTH_SHORT).show();
        }
        else {
            placesShown.clear();
            for (int i = currentPageIndex; i < currentPageIndex + tam && i < places.size(); i++) {
                placesShown.add(places.get(i));
            }
            this.Conf_List_Route(placesShown);
        }


    }

}

