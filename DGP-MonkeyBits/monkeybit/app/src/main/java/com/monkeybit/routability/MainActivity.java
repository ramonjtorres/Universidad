package com.monkeybit.routability;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.ColorStateList;
import android.support.annotation.NonNull;
import android.support.design.widget.BottomNavigationView;
import android.support.design.widget.NavigationView;
import android.support.v4.app.Fragment;
import android.support.v4.content.ContextCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.auth.FirebaseAuth;

import java.security.AccessControlContext;
import java.util.ArrayList;

import static com.android.volley.VolleyLog.TAG;
import static java.security.AccessController.getContext;

public class MainActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener, NavigationView.OnNavigationItemSelectedListener, AlertDialogResponseInterface {
    private FirebaseAuth mAuth;
    public BottomNavigationView bottomNavigationView;
    public NavigationView navigationView;
    public DrawerLayout mainDrawerLayout;
    private Fragment selectedFragment;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        mAuth = FirebaseAuth.getInstance();
        LoadNewFragment(new MenuActivity());
        mainDrawerLayout = findViewById(R.id.main_drawer);
        bottomNavigationView =  findViewById(R.id.NavigationViewRutes);
        this.selectedFragment = new RouteActivity();
        LoadNewFragment(this.selectedFragment);
        bottomNavigationView.setOnNavigationItemSelectedListener(this);
        navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(final MenuItem menuItem) {
                int aux = bottomNavigationView.getMenu().size();
                //cogemos el tamaño
                for(int i = 0; i < aux; i++){
                    bottomNavigationView.getMenu().getItem(i).setChecked(false);
                }//desactivamos todos

                selectedFragment = new MenuActivity();
                switch (menuItem.getItemId()) {
                    case R.id.nav_profile:
                        if (mAuth.getCurrentUser() == null) {
                            selectedFragment = new AccountActivity();
                        } else {
                            selectedFragment = new UserProfileActivity();
                        }
                        break;
                    case R.id.nav_logout:
                        onLogOut();
                        selectedFragment = new MenuActivity();
                        break;
                    case R.id.nav_accesibility:
                        // @TODO: asignar a selectedFragment el Fragmen de opciones de accesibilidad
                         //selectedFragment = new FavActivity();
                        break;
                }
                if (selectedFragment != null) {
                    mainDrawerLayout.closeDrawer(navigationView);
                    LoadNewFragment(selectedFragment);
                }
                return true;
            }
        });
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
       // this.selectedFragment = new RouteActivity();

        switch (item.getItemId()) {
            case R.id.menu_rutas:
                this.selectedFragment = new RouteActivity();
                break;
            case R.id.menu_maps:
                // @TODO: asignar a selectedFragment el Fragmen de mapas
                // selectedFragment = new MapsActivity();
                break;
            case R.id.menu_fav:
                this.selectedFragment = new FavActivity();
                break;
        }
        if (this.selectedFragment != null) {
            LoadNewFragment(this.selectedFragment);
        }
        return true;
    }


    public void OnShowOptionMenu(View view) {
        if (!(mainDrawerLayout.isDrawerOpen(navigationView))) {
            mainDrawerLayout.openDrawer(navigationView);
        }
    }

    public void LoadNewFragment(Fragment newFragment) {
        getSupportFragmentManager().beginTransaction().replace(R.id.fragmentContainer, newFragment).commit();
    }

    public void onLogOut() {
        if (mAuth.getCurrentUser() != null) {
            this.newAlertDialog(this, AlertID.LOGOUT, getString(R.string.close_session_dialog));
        } else {
            Toast toast = Toast.makeText(this, getString(R.string.logged_out_fail), Toast.LENGTH_SHORT);
            toast.show();
        }
    }

    public void newAlertDialog(final AlertDialogResponseInterface caller, final AlertID alertID, String dialog) {
        AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
        alertDialog.setTitle(R.string.alert_dialog_tittle);
        alertDialog.setCancelable(false);
        alertDialog.setMessage(getString(R.string.dialog_alert_question_body) + " " + dialog + "?");
        alertDialog.setPositiveButton(R.string.alert_dialog_positive, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                caller.PositiveResponse(alertID);
            }
        });
        alertDialog.setNegativeButton(R.string.alert_dialog_negative, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                caller.NegativeResponse(alertID);
            }
        });
        alertDialog.show();
    }

    @Override
    public void PositiveResponse(AlertID alertID) {
        switch (alertID) {
            case LOGOUT:
                logOut();
                break;
        }
    }

    @Override
    public void NegativeResponse(AlertID alertID) {
        switch (alertID) {
            case LOGOUT:
                break;
        }
    }

    public void logOut() {
        if (mAuth.getCurrentUser() != null) {
            mAuth.signOut();
            Toast toast = Toast.makeText(this, getString(R.string.logged_out), Toast.LENGTH_SHORT);
            toast.show();
        } else {
            Toast toast = Toast.makeText(this, getString(R.string.logged_out_fail), Toast.LENGTH_SHORT);
            toast.show();
        }
    }

    public String getUserEmail() {
        if (mAuth.getCurrentUser() != null) {
            return mAuth.getCurrentUser().getEmail();
        } else {
            return null;
        }
    }
}

