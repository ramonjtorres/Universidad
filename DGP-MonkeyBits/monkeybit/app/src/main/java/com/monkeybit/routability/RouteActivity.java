package com.monkeybit.routability;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.BottomNavigationView;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;


public class RouteActivity extends Fragment implements BottomNavigationView.OnNavigationItemSelectedListener {
    public BottomNavigationView menuRutes;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_route, container, false);
        getFragmentManager().beginTransaction().replace(R.id.frame_rp_view, new ListRouteActivity()).commit(); //by default
        menuRutes = view.findViewById(R.id.NavViewRutePlace); //the fragment
        menuRutes.setOnNavigationItemSelectedListener(this); //listener, when click an option, the listener is called

        return view;
        // return super.onCreateView(inflater, container, savedInstanceState);
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        Fragment selectedFragment = new ListRouteActivity();
        switch (item.getItemId()) {
            case R.id.menu_rutas:
                selectedFragment = new ListRouteActivity();
                break;
            case R.id.menu_places:
                // @TODO: asignar a selectedFragment el Fragmen de opciones de lugares
                selectedFragment = new ListPlaceActivity();
                break;
            case R.id.menu_search:
                // @TODO: asignar a selectedFragment el Fragmen de opciones de busqueda
                selectedFragment = new searchActivity();
                ((searchActivity) selectedFragment).setFav(false);
                break;
        }
        if (selectedFragment != null) {
            // dis linea
            getFragmentManager().beginTransaction().replace(R.id.frame_rp_view, selectedFragment).commit();
        }

        return true;
    }

}
