package com.monkeybit.routability;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
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


public class ListFavRouteActivity extends Fragment implements DBConnectInterface{
    View view;
    private String email;
    int pag = 0;
    int max = 10;
    private int result = 0;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.list_routes, container, false);

        email = ((MainActivity) getActivity()).getUserEmail();
        DBConnect.getFavoriteRoutes(getContext(),this, email);

        return view;
    }

    public void LoadArray(JSONArray jsonArray){
        ArrayList<ListRoute> list = new ArrayList<>();

        for(int i=0;i<jsonArray.length();i++){
            try {
                JSONObject json = jsonArray.getJSONObject(i);
                //Get and save data

                String idImage = json.getString("Image");
                String tittle = json.getString("Name");
                String description = json.getString("Description");

                String idRoute = json.getString("IdRoute");
                String desc_imagen = json.getString("ImageDescription");
                list.add(new ListRoute(idImage, tittle,description , idRoute,desc_imagen));


            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        pag = pag + max;
        this.Conf_List_Route(list);
    }

    protected void Conf_List_Route(ArrayList<ListRoute> dataList){

        ListView list = view.findViewById(R.id.list_rt);
        //adapt to the list

        if(list!=null) {
            list.setAdapter(new AdapterList(getContext(), R.layout.post_rute, dataList) {
                @Override
                public void onPost(Object post, View view) {
                    if (post != null) {
                        TextView tittle = view.findViewById(R.id.post_tittle);
                        if (tittle != null)
                            tittle.setText(((ListRoute) post).get_Tittle());

                        TextView description = view.findViewById(R.id.post_desc);
                        if (description != null)
                            description.setText(((ListRoute) post).get_Description());

                        ImageView img = view.findViewById(R.id.post_img);
                        if (img != null)
                            Picasso.get().load(((ListRoute) post).get_idImagen()).into(img);
                            //img.setContentDescription( ((ListRoute) post).getImageDescription() );
                    }
                }
            });

            list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                @Override
                public void onItemClick(AdapterView<?> post, View view, int pos, long id) {
                    //Toast toast = Toast.makeText(getContext()," Pulsado", Toast.LENGTH_SHORT);
                    //toast.show();
                    ListRoute choosen = (ListRoute) post.getItemAtPosition(pos);
                    RouteView route = new RouteView();
                    Bundle bundle = new Bundle();
                    bundle.putString("routeId", choosen.get_idRoute());
                    route.setArguments(bundle);
                    Log.d("Debug","choosen: "+choosen);
                    if (route != null) {

                        getActivity().getSupportFragmentManager().beginTransaction().replace(R.id.frame_rp_view, route).commit(); //go to the fragment

                    }


                }
            });
        }
    }


    @Override
    public void onErrorResponse(VolleyError error) {
        Toast.makeText(getContext(), "Error" + error, Toast.LENGTH_SHORT).show();

    }

    @Override
    public void onResponse(JSONObject response) {
        try {
            if (response.has("GET_FAVORITE_ROUTES")) {
                JSONArray operationResult = response.getJSONArray("GET_FAVORITE_ROUTES"); // Este elemento tendrá la/s tupla/s
                LoadArray(operationResult);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
}